<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::search(request(['keyword','status']))->paginate(5)->withQueryString();

        $totalBookings = Book::count();
        $totalConfirmedBookings = Book::where('payment_status', 'success')->count();
        $totalPendingBookings = Book::where('payment_status', 'pending')->count();
        $totalChallengeBookings = Book::where('payment_status', 'challenge')->count();

        return view('dashboard.books', compact('totalBookings', 'totalConfirmedBookings', 'totalPendingBookings','totalChallengeBookings', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => [
                'required',
                'regex:/^(08|\+628)[0-9]{7,11}$/'
            ],
            'booking_date' => [
                'required',
                'date',
                'after_or_equal:today'
            ],
            'schedule_id' => [
                'required',
                'exists:schedules,id'
            ],
        ], [
            'schedule_id.required' => 'Please select a valid time slot.',
            'schedule_id.exists' => 'The selected time slot is invalid.',
        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['court_id'] = $request->input('court_id');

        $book = Book::create($validated);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        \Midtrans\Config::$overrideNotifUrl = config('app.url') . '/api/midtrans-callback';

        $params = array(
            'transaction_details' => array(
                'order_id' => 'ORDER-' . rand(),
                'gross_amount' => $book->court->price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->first_name,
                'email' => Auth::user()->email,
                'phone' => $book->phone_number,
            ),
            'item_details' => array(
                array(
                    'id' => 'court-' . $book->court->id,
                    'price' => $book->court->price,
                    'quantity' => 1,
                    'name' => $book->court->name
                )
            ),
            'callbacks' => [
                'finish' => config('app.url') . '/dashboard/booking-history'
            ],
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $book->snap_token = $snapToken;
        $book->order_id = $params['transaction_details']['order_id'];
        $book->save();

        return redirect('/payment-confirmation/book/' . $book->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->user->id !== Auth::user()->id) {
            abort(404);
        }

        $book->delete();

        return redirect('/');
    }
}
