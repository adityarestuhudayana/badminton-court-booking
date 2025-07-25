<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SocialiteController;
use App\Jobs\ProcessWelcomeMail;
use App\Mail\WelcomeMail;
use App\Models\Book;
use App\Models\Court;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    $courts = Court::all();

    return view('welcome', [
        'courts' => $courts,
    ]);
});

Route::get('/court-detail/{court}', function (Court $court, Request $request) {
    $selectedDate = $request->input('date', date('Y-m-d')); // Default hari ini
    $schedules = Schedule::all();
    $books = Book::where('court_id', $court->id)
        ->whereDate('booking_date', $selectedDate)
        ->where('payment_status', 'success')
        ->get();

    return view('detail-court', compact('court', 'schedules', 'books', 'selectedDate'));
});

Route::post('/sign-up', [AuthController::class, 'register']);

Route::post('/sign-in', [AuthController::class, 'login']);


Route::middleware(['guest'])->group(function () {

    Route::get('/sign-up', function () {
        return view('register');
    });

    Route::get('/sign-in', function () {
        return view('login');
    });
});

Route::middleware(['auth', 'admin','verified'])->group(function () {

    Route::resource('/dashboard/schedules', ScheduleController::class);

    Route::resource('/dashboard/courts', CourtController::class);

    Route::get('/dashboard', function (Request $request) {
        $now = Carbon::now();
        $today = $now->toDateString();
        $days = $request->get('days', 7); // default 7 hari terakhir

        // --- Statistik utama ---
        $todaysBookings = Book::whereDate('booking_date', $today)->count();

        $monthlyRevenue = Book::with('court')
            ->where('payment_status', 'success')
            ->whereYear('booking_date', $now->year)
            ->whereMonth('booking_date', $now->month)
            ->get()
            ->sum(fn($book) => $book->court->price ?? 0);

        $totalMember = User::where('role', '!=', 'admin')->count();

        $books = Book::whereDate('created_at', $today)->paginate(3)->withQueryString();

        // --- Rentang tanggal sama untuk booking trend dan revenue ---
        $startDate = $now->copy()->subDays($days - 1)->startOfDay();
        $endDate = $now->copy()->endOfDay();

        $dateRange = collect(range(0, $days - 1))->map(fn($i) => $startDate->copy()->addDays($i)->format('Y-m-d'));

        // Booking trend per hari (count booking)
        $bookingRawData = Book::select(DB::raw('DATE(booking_date) as date'), DB::raw('count(*) as total'))
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $bookingTrend = $dateRange->map(fn($date) => [
            'date' => $date,
            'total' => $bookingRawData[$date] ?? 0,
        ]);

        // Revenue per hari (sum price dari relasi court)
        $revenueRawData = Book::with('court')
            ->where('payment_status', 'success')
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->get()
            ->groupBy(fn($book) => \Carbon\Carbon::parse($book->booking_date)->format('Y-m-d'))
            ->map(fn($group) => $group->sum(fn($book) => $book->court->price ?? 0));

        $revenueLastWeek = $dateRange->mapWithKeys(fn($date) => [
            $date => $revenueRawData[$date] ?? 0
        ]);

        return view('dashboard.index', compact(
            'todaysBookings',
            'monthlyRevenue',
            'totalMember',
            'books',
            'bookingTrend',
            'days',
            'revenueLastWeek'
        ));
    });
});


Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard/booking-history', function () {
        $books = Book::where('user_id', Auth::user()->id)->get();

        return view('dashboard.booking-history', ['books' => $books]);
    });

    Route::resource('/dashboard/books', BookController::class);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::put('/update/profile/{user}', [AuthController::class, 'update']);

    Route::get('/payment-confirmation/book/{book}', function (Book $book) {
        if ($book->user->id !== Auth::user()->id) {
            abort(404);
        }
        return view('payment-confirmation', ['book' => $book]);
    });
});

Route::get('/auth/google/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->intended('/dashboard/booking-history');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');