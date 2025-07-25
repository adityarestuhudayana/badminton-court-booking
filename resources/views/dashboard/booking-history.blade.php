<x-dashboard-layout>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: var(--bs-dark);">
                    <i class="fas fa-basketball-ball me-2"></i>My Booking
                </h2>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                <a class="btn btn-primary-custom" href="/#lapangan">
                    <i class="fas fa-plus me-2"></i>Booking Now
                </a>
            </div>
        </div>

        <div class="card card-custom mb-4">
            <div class="card-body">
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Booking Date</th>
                                <th class="text-center">Court</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Phone Number</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $book->booking_date }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ Str::substr($book->court->image_url, 0, 12) === 'court_images' ? '/storage/' . $book->court->image_url : $book->court->image_url }}"
                                                class="court-img me-3">
                                            <span class="fw-medium">{{ $book->court->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $book->user->first_name }}</td>
                                    <td>Rp{{ number_format($book->court->price, 0, ',', '.') }}</td>
                                    <td>{{ $book->phone_number }}</td>
                                    <td>{{ $book->schedule->start_time }}</td>
                                    <td>{{ $book->schedule->end_time }}</td>
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

                                    @if ($book->payment_status === 'pending' || $book->payment_status === 'challenge')
                                        <td class="d-flex">
                                            <div class="d-flex align-items-end me-2">
                                                <a class="btn btn-primary"
                                                    href="/payment-confirmation/book/{{ $book->id }}">
                                                    Bayar
                                                </a>
                                            </div>

                                            <form action="/dashboard/books/{{ $book->id }}" method="post"
                                                class="text-center mt-3">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Batalkan</button>
                                            </form>
                                        </td>
                                    @elseif ($book->payment_status == 'failed')
                                     <td class="">
                                            <form action="/dashboard/books/{{ $book->id }}" method="post"
                                                class="text-center mt-3">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Batalkan</button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge text-bg-success align-self-center">Success</span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-dashboard-layout>
