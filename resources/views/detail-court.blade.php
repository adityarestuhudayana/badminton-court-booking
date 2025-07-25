@php
    $isAuthenticated = auth()->user() ?? false;

    $imgSrc =
        Str::substr($court->image_url, 0, 12) === 'court_images' ? '/storage/' . $court->image_url : $court->image_url;
@endphp


<x-landing-layout>
    <!-- Court Header Section -->
    <section class="court-header"
        style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('{{ $imgSrc }}') center/cover no-repeat;">
        <div class="container">
            <a href="/#lapangan" class="btn btn-secondary rounded-pill mb-3"><i
                    class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            <div class="court-header-content">
                <div class="court-price-tag">Rp{{ number_format($court->price, 0, ',', '.') }} <span>/ 3 jam</span></div>
                <h1 class="court-detail-title text-white">{{ $court->name }}</h1>
                <p class="lead">Lapangan premium dengan spasi lebih luas dan lantai kayu berkualitas tinggi</p>
                {{-- <div class="d-flex align-items-center">
                    <span class="me-3"><i class="fas fa-star text-warning"></i> 4.8 (156 reviews)</span>
                    <span><i class="fas fa-map-marker-alt text-danger"></i> Jakarta Pusat</span>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Court Details Section -->
    <section class="court-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-4">Deskripsi Lapangan</h2>
                    <p class="lead mb-4">Lapangan Badminton kami dirancang khusus untuk memberikan pengalaman
                        bermain terbaik dengan spesifikasi internasional.</p>

                    <p>Lapangan ini memiliki ukuran standar BWF (5.18m x 13.4m) dengan lantai kayu maple yang memberikan
                        daya pantul optimal untuk shuttlecock. Dilengkapi dengan sistem pencahayaan LED profesional yang
                        mengurangi bayangan dan silau, serta ventilasi udara yang optimal untuk kenyamanan bermain.</p>

                    <div class="mt-5">
                        <h3 class="fw-bold mb-4">Fasilitas Khusus</h3>
                        <ul class="feature-list">
                            <li>Lantai kayu maple dengan underlayment khusus</li>
                            <li>Sistem pencahayaan LED profesional (1200 lux)</li>
                            <li>Ventilasi udara dan AC terkontrol</li>
                            <li>Tempat duduk penonton kapasitas 20 orang</li>
                            <li>Locker pribadi dengan kunci elektronik</li>
                            <li>Shower dan area ganti pribadi</li>
                            <li>Free WiFi high speed</li>
                            <li>Raket dan shuttlecock premium tersedia untuk disewa</li>
                        </ul>
                    </div>

                    <div class="mt-5">
                        <h3 class="fw-bold mb-4">Gallery Lapangan</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="gallery-item">
                                    <img src="https://images.unsplash.com/photo-1599391398131-cd12dfc6c24e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGJhZG1pbnRvbiUyMGNvdXJ0fGVufDB8fDB8fHww"
                                        class="img-fluid w-100 h-100"
                                        alt="Lapangan badminton VIP dengan lantai kayu maple yang mengkilap"
                                        style="object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="gallery-item">
                                    <img src="https://images.unsplash.com/photo-1599474924187-334a4ae5bd3c?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fGJhZG1pbnRvbiUyMGNvdXJ0fGVufDB8fDB8fHww"
                                        class="img-fluid w-100 h-100"
                                        alt="Area duduk penonton dengan kursi empuk dan view langsung lapangan"
                                        style="object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="gallery-item">
                                    <img src="https://images.unsplash.com/photo-1617696618050-b0fef0c666af?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmFkbWludG9uJTIwY291cnR8ZW58MHx8MHx8fDA%3D"
                                        class="img-fluid w-100 h-100"
                                        alt="Fasilitas shower modern dengan perlengkapan mandi lengkap"
                                        style="object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="mt-5">
                        <h3 class="fw-bold mb-4">Testimoni</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="testimonial-card">
                                    <div class="d-flex mb-3">
                                        <img src="https://placehold.co/100x100" class="testimonial-img"
                                            alt="Profil pengguna laki-laki tersenyum">
                                        <div>
                                            <h5 class="mb-1">Budi Santoso</h5>
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>"Lapangan terbaik yang pernah saya gunakan. Lantainya nyaman untuk berlari dan
                                        shuttlecock tidak cepat rusak karena kualitas udara yang terjaga."</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="testimonial-card">
                                    <div class="d-flex mb-3">
                                        <img src="https://placehold.co/100x100" class="testimonial-img"
                                            alt="Profil pengguna perempuan tersenyum">
                                        <div>
                                            <h5 class="mb-1">Ani Wijaya</h5>
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>"Tempatnya sangat bersih dan nyaman. Fasilitas shower setelah bermain membuat
                                        saya segar kembali. Harga sesuai dengan kualitas yang diberikan."</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <!-- Booking Form Sidebar -->
                <div class="col-lg-4">
                    <div class="" style="top: 20px;">
                        <div class="booking-form-card">
                            <div class="form-header">
                                <h3 class="fw-bold">Formulir Booking</h3>
                                <p class="text-muted m-0">Isi data untuk memesan lapangan</p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="bookingForm" method="POST" action="/dashboard/books">
                                @csrf

                                <div class="mb-3">
                                    <label for="bookingPhone" class="form-label">
                                        Nomor Telepon <span class="text-danger">*</span>
                                    </label>
                                    <input type="tel" class="form-control" id="bookingPhone" name="phone_number"
                                        pattern="^(08|\+628)[0-9]{7,11}$" placeholder="Contoh: 081234567890"
                                        value="{{ old('phone_number') }}">
                                    <div class="form-text">Masukkan nomor telepon diawali 08 atau +628</div>
                                </div>

                                <div class="mb-3">
                                    <label for="bookingDate" class="form-label">
                                        Tanggal Booking <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="bookingDate" name="booking_date"
                                        value="{{ $selectedDate }}"
                                        onchange="window.location.href='?date=' + this.value">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label d-block">Jam tersedia <span
                                            class="text-danger">*</span></label>
                                    <div class="d-flex flex-wrap mb-2">
                                        @foreach ($schedules as $schedule)
                                            @php
                                                $isBooked = $books->contains(function ($book) use ($schedule) {
                                                    return $book->schedule->id === $schedule->id;
                                                });
                                            @endphp

                                            <span class="time-slot-btn {{ $isBooked ? 'disabled' : '' }}"
                                                data-id="{{ $schedule->id }}">
                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <small class="text-muted">Jam operasional: 10:00-22:00 WIB</small>
                                    <input type="hidden" name="schedule_id" id="scheduleId">
                                </div>

                                <input type="hidden" name="court_id" value="{{ $court->id }}">

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary py-3 fw-bold">
                                        <i class="fas fa-calendar-check me-2"></i> Pesan Sekarang
                                    </button>
                                </div>

                                <div class="mt-3 text-center">
                                    <small class="text-muted">Kami akan mengirim konfirmasi ke nomor telepon Anda dalam
                                        15 menit</small>
                                </div>
                            </form>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-info-circle me-2"></i> Info Penting</h5>
                                <ul class="list-unstyled">
                                    {{-- <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>
                                        Pembatalan gratis 24 jam sebelumnya</li> --}}
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Free
                                        shuttlecock untuk pemesanan > 2 jam</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i> Parkir motor gratis</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-landing-layout>

<script>
    document.getElementById('bookingPhone').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+]/g, '');
    });

    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.time-slot-btn');

        buttons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const scheduleIdInput = document.getElementById('scheduleId');

                // Ambil ID dari data-id
                const id = btn.getAttribute('data-id');
                scheduleIdInput.value = id;

                // Hapus class 'selected' dari semua
                buttons.forEach(b => b.classList.remove('selected'));

                // Tambah class 'selected' ke yang diklik
                btn.classList.add('selected');
            });
        });
    });
</script>
