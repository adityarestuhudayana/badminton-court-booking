<x-dashboard-layout>
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card p-3 d-flex flex-row align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                    <i class="fas fa-calendar-day fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">Today's Bookings</div>
                    <div class="fs-5 fw-bold">{{ $todaysBookings }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card p-3 d-flex flex-row align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle me-3">
                    <i class="fas fa-money-bill-wave fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">Monthly Revenue</div>
                    <div class="fs-5 fw-bold">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card p-3 d-flex flex-row align-items-center">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle me-3">
                    <i class="fas fa-users fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">Active Members</div>
                    <div class="fs-5 fw-bold">{{ $totalMember }}</div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3 col-md-6">
            <div class="card p-3 d-flex flex-row align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle me-3">
                    <i class="fas fa-map-marker-alt fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">Available Courts</div>
                    <div class="fs-5 fw-bold">8/10</div>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Charts -->
    <div class="row g-3 mb-4">
        <div class="col-lg-6">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Booking Trends</h5>
                </div>

                <canvas id="bookingTrendChart" height="300" width="600"></canvas>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Revenue Breakdown</h5>
                </div>
                <canvas id="revenueLastWeekChart" height="300" width="600"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Recent Bookings</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
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
                    @foreach ($books as $key => $book)
                        <tr>
                            <td>{{ $books->firstItem() + $key }}</td>
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
        <div class="card-footer bg-light">
            {{ $books->links() }}
        </div>
    </div>
</x-dashboard-layout>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // --- Revenue Last Week (Bar Chart) ---
    const revenueLastWeekData = @json($revenueLastWeek);

    const revenueLastWeekLabels = Object.keys(revenueLastWeekData).map(date => {
        return new Date(date).toLocaleDateString('en-US', {
            weekday: 'short',
            month: 'short',
            day: 'numeric'
        }); // Contoh: "Mon, Jul 15"
    });

    const revenueLastWeekTotals = Object.values(revenueLastWeekData);

    const ctxRevenue = document.getElementById('revenueLastWeekChart').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'bar',
        data: {
            labels: revenueLastWeekLabels,
            datasets: [{
                label: 'Revenue Last Week',
                data: revenueLastWeekTotals,
                backgroundColor: '#36b9cc',
                borderRadius: 5,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Revenue Breakdown - Last Week'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // --- Booking Trend (Line Chart) ---
    const bookingTrendData = @json($bookingTrend);

    const bookingTrendLabels = bookingTrendData.map(item => {
        return new Date(item.date).toLocaleDateString('en-US', {
            weekday: 'short',
            month: 'short',
            day: 'numeric'
        }); // contoh: "Mon, Jul 22"
    });

    const bookingTrendTotals = bookingTrendData.map(item => item.total);

    const ctxBooking = document.getElementById('bookingTrendChart').getContext('2d');
    new Chart(ctxBooking, {
        type: 'line',
        data: {
            labels: bookingTrendLabels,
            datasets: [{
                label: 'Bookings',
                data: bookingTrendTotals,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Booking Trend - Last Week'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Bookings'
                    }
                }
            }
        }
    });

    // --- Dropdown filter untuk bookingTrend ---
    const filterSelect = document.getElementById('filterDays');
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            const days = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('days', days);
            window.location.href = url.toString();
        });
    }
</script>
