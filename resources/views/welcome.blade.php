<x-landing-layout>

    <!-- Hero Section -->
    <div class="position-relative bg-primary overflow-hidden text-white hero">
        <div class="container py-5">
            <div class="row align-items-center">
                <!-- Text Content -->
                <div class="col-lg-6 py-5">
                    <h1 class="display-4 fw-bold mb-3">
                        <div>Booking Lapangan</div>
                        <div class="text-light">Badminton Anda</div>
                    </h1>
                    <p class="lead mb-4">
                        Pilih waktu dan lapangan favorit Anda dengan mudah melalui sistem booking online kami.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="#lapangan" class="btn btn-light text-primary fw-medium px-4 py-2">
                            Booking Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Booking Section -->
    <header class="header text-center col-10 mx-auto rounded-3" id="lapangan">
        <div class="container">
            <h1 class="header-title mb-3">BADMINTON COURT BOOKING</h1>
            <p class="header-subtitle">Pilih lapangan favoritmu dan booking sekarang!</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <div class="row">

            @foreach ($courts as $court)
                <a class="col-md-4 text-decoration-none" href="/court-detail/{{ $court->id }}">
                    <div class="court-card">
                        <div class="court-image">
                            <img src="{{ Str::substr($court->image_url, 0, 12) === 'court_images' ? '/storage/' . $court->image_url : $court->image_url }}"
                                alt="Lapangan badminton indoor modern dengan penerangan LED dan lantai kayu maple"
                                width="600" height="400">
                        </div>
                        <div class="card-body">
                            <h3 class="court-title">{{ $court->name }}</h3>

                            <div class="price">Rp{{ number_format($court->price, 0, ',', '.') }} <span>/3 jam</span>
                            </div>


                            <button class="btn btn-primary w-100">
                                <i class="fas fa-calendar-check"></i> BOOK SEKARANG
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </main>


    <!-- Features Section -->
    <div class="py-5 bg-white" id="tentang">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-semibold text-uppercase">
                    Keunggulan
                </h6>
                <h2 class="fw-bold">
                    Mengapa Memilih Kami
                </h2>
                <p class="text-muted fs-5">Layanan terbaik untuk pengalaman bermain badminton Anda</p>
            </div>

            <div class="row g-4">
                <!-- Booking 24 Jam -->
                <div class="col-md-6 d-flex">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center bg-danger text-white rounded-circle me-3"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-semibold">Booking 24 Jam</h5>
                            <p class="text-muted mb-0">Sistem online yang memungkinkan Anda booking kapan saja tanpa
                                perlu telepon.</p>
                        </div>
                    </div>
                </div>

                <!-- Konfirmasi Instan -->
                <div class="col-md-6 d-flex">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center bg-success text-white rounded-circle me-3"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-semibold">Konfirmasi Instan</h5>
                            <p class="text-muted mb-0">Dapatkan konfirmasi booking langsung via email/WhatsApp setelah
                                pembayaran.</p>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran Fleksibel -->
                <div class="col-md-6 d-flex">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-3"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-semibold">Pembayaran Fleksibel</h5>
                            <p class="text-muted mb-0">Berbagai metode pembayaran tersedia termasuk transfer bank dan
                                e-wallet.</p>
                        </div>
                    </div>
                </div>

                <!-- Dukungan Pelanggan -->
                <div class="col-md-6 d-flex">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center bg-warning text-white rounded-circle me-3"
                                style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-headset"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-semibold">Dukungan Pelanggan</h5>
                            <p class="text-muted mb-0">
                                Tim customer service siap membantu via WhatsApp selama jam operasional.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-semibold text-uppercase">FAQ</h6>
                <h2 class="fw-bold">Pertanyaan yang Sering Diajukan</h2>
                <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">
                    Temukan jawaban atas pertanyaan umum seputar layanan kami
                </p>
            </div>

            <div class="accordion accordion-flush shadow-sm rounded" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseOne" aria-expanded="false" aria-controls="faqCollapseOne">
                            Bagaimana cara memesan lapangan?
                        </button>
                    </h2>
                    <div id="faqCollapseOne" class="accordion-collapse collapse" aria-labelledby="faqHeadingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anda cukup login ke akun Anda, pilih lapangan yang tersedia, lalu pilih jadwal dan klik
                            "Pesan".
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                            Apa metode pembayaran yang tersedia?
                        </button>
                    </h2>
                    <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Kami mendukung pembayaran melalui transfer bank, e-wallet (OVO, GoPay, DANA), dan kartu
                            kredit.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseThree" aria-expanded="false"
                            aria-controls="faqCollapseThree">
                            Bisakah saya membatalkan pemesanan?
                        </button>
                    </h2>
                    <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Tidak bisa. Semua pemesanan bersifat final dan tidak dapat dibatalkan, kecuali terjadi
                            kesalahan sistem atau pembatalan dari pihak pengelola.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- CTA Section -->
    <div class="bg-primary">
        <div class="container text-center py-5 py-sm-6 py-lg-7 px-3 px-sm-4 px-lg-5 text-white">
            <h2 class="fw-extrabold fs-2 fs-sm-1">
                <span>Siap Bermain Hari Ini?</span>
            </h2>
            <p class="mt-3 fs-5 text-white-50">
                Temukan lapangan badminton terbaik dan buat booking sekarang juga.
            </p>
            <a href="#lapangan" class="btn btn-light btn-lg mt-4 px-4 px-sm-5 text-primary fw-semibold">
                Booking Sekarang
            </a>
        </div>
    </div>

</x-landing-layout>
