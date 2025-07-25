<x-dashboard-layout>

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: #2a4365;">
                    <i class="fas fa-calendar-alt me-2"></i>Manage Bookings
                </h2>
                <p class="text-muted">Admin dashboard to manage badminton court bookings</p>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card card-custom h-100 stats-card total">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Bookings</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalBookings }}</h3>
                            </div>
                            <div class="bg-light-primary rounded-circle p-3">
                                <i class="fas fa-calendar text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card card-custom h-100 stats-card confirmed">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Confirmed</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalConfirmedBookings }}</h3>
                            </div>
                            <div class="bg-light-success rounded-circle p-3">
                                <i class="fas fa-check-circle text-success fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card card-custom h-100 stats-card pending">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Pending</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalPendingBookings }}</h3>
                            </div>
                            <div class="bg-light-warning rounded-circle p-3">
                                <i class="fas fa-clock text-warning fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card card-custom h-100 stats-card cancelled">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Challenge</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalChallengeBookings }}</h3>
                            </div>
                            <div class="bg-light-warning rounded-circle p-3">
                                <i class="fas fa-shield-alt text-info fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-custom mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <form action="" method="GET">
                            <div class="position-relative">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" name="keyword" class="form-control search-box"
                                    placeholder="Search by user name / court name / user email"
                                    value="{{ request('keyword') }}" autocomplete="off">
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4">
                        <div class="d-flex justify-content-md-end gap-2">
                            <select class="form-select filter-btn"
                                onchange="window.location.href='?status='+this.value">
                                <option value="">All Status</option>
                                <option value="success">Confirmed</option>
                                <option value="pending">Pending</option>
                                <option value="challenge">Challenge</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Court</th>
                                <th>Customer</th>
                                <th>Booking Date</th>
                                <th>Time Slot</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ Str::substr($book->court->image_url, 0, 12) === 'court_images' ? '/storage/' . $book->court->image_url : $book->court->image_url }}"
                                                alt="Badminton court 1 with wooden floor and bright lighting"
                                                class="court-img me-3">
                                            <span class="fw-medium">{{ $book->court->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium">{{ $book->user->first_name }}</span>
                                            <small class="text-muted">{{ $book->phone_number }}</small>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($book->booking_date)->format('d F Y') }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium">{{ $book->schedule->start_time }} -
                                                {{ $book->schedule->end_time }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span
                                                class="fw-medium">Rp{{ number_format($book->court->price, 0, ',', '.') }}</span>
                                            @if ($book->payment_status == 'success')
                                                <small class="text-success">Paid</small>
                                            @elseif ($book->payment_status == 'pending')
                                                <small class="text-warning">Pending</small>
                                            @elseif ($book->payment_status == 'challenge')
                                                <small class="text-info">Challenge</small>
                                            @elseif ($book->payment_status == 'failed')
                                                <small class="text-danger">Failed</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if ($book->payment_status === 'pending')
                                            <span class="badge-status badge-pending">
                                                <i class="fas fa-hourglass-half me-1"></i>Waiting Payment
                                            </span>
                                        @elseif ($book->payment_status === 'success')
                                            <span class="badge-status badge-success">
                                                <i class="fas fa-check-circle me-1"></i>Paid
                                            </span>
                                        @elseif ($book->payment_status === 'challenge')
                                            <span class="badge-status badge-warning">
                                                <i class="fas fa-shield-alt me-1"></i>Challenge
                                            </span>
                                        @else
                                            <span class="badge-status badge-failed">
                                                <i class="fas fa-times-circle me-1"></i>Failed
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
