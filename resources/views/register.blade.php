<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --secondary-color: #f8fafc;
            --dark-color: #1e293b;
            --light-color: #f1f5f9;
            --text-color: #64748b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .register-container {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
            background-color: white;
        }

        .register-left {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-left h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .register-left p {
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            margin-bottom: 1rem;
            padding-left: 2rem;
            position: relative;
        }

        .feature-list li::before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            color: white;
        }

        .register-right {
            padding: 3rem;
        }

        .logo {
            font-weight: 800;
            font-size: 1.75rem;
            color: var(--primary-color);
            margin-bottom: 2rem;
            display: inline-block;
        }

        .form-title {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: var(--text-color);
            margin-bottom: 2rem;
        }

        .form-floating label {
            color: var(--text-color);
        }

        .form-control {
            padding: 1rem 1rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
            border-color: var(--primary-color);
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--text-color);
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .social-btn {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
        }

        .social-btn:hover {
            background-color: var(--light-color);
            transform: translateY(-2px);
        }

        .social-btn i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-color);
        }

        .login-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }

        @media (max-width: 992px) {
            .register-left {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row register-container">
            <!-- Left Side (Illustration/Info) -->
            <div class="col-lg-6 register-left d-none d-lg-block">
                <div>
                    <h2>Atur Jadwal Main Badminton Lebih Praktis</h2>
                    <p>Dengan akun, pemesanan lapangan jadi lebih cepat dan mudah diakses kapan pun Anda butuh.</p>

                    <ul class="feature-list">
                        <li>Booking lapangan tanpa antre</li>
                        <li>Lihat dan pilih jam yang tersedia dengan cepat</li>
                        <li>Simpan riwayat dan bukti pemesanan</li>
                    </ul>
                </div>

                <div class="mt-5">
                    <img src="https://media.istockphoto.com/id/1391562342/photo/taiwanese-badminton-players-warm-up-exercise-practicing-in-badminton-court-endurance-training.webp?a=1&b=1&s=612x612&w=0&k=20&c=NV2kgNDKX1QK3qusFs68hpYtaE8V9-_1HPt-YMg_SfM="
                        alt="Ilustrasi tampilan dashboard modern dengan grafik dan elemen UI" class="img-fluid rounded">
                </div>
            </div>

            <!-- Right Side (Form) -->
            <div class="col-lg-6 register-right">
                <span class="logo">BadmintonGo<span style="color: var(--primary-hover);">.</span></span>
                <h1 class="form-title">Buat Akun Baru</h1>
                <p class="form-subtitle">Isi formulir berikut untuk memulai perjalanan Anda</p>

                <form id="registerForm" method="POST" action="/sign-up">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    id="firstName" placeholder="Nama Depan" name="first_name" value="{{ old('first_name') }}">
                                <label for="firstName">Nama Depan</label>

                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="lastName" placeholder="Nama Belakang" name="last_name" value="{{ old('last_name') }}">
                                <label for="lastName">Nama Belakang</label>

                                @error('last_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="Alamat Email" name="email" value="{{ old('email') }}">
                                <label for="email">Alamat Email</label>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Buat Password" name="password">
                                <label for="password">Password</label>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text text-muted">Gunakan setidaknya 8 karakter dengan kombinasi huruf
                                    dan angka.</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="confirmPassword" placeholder="Konfirmasi Password" name="password_confirmation">
                                <label for="confirmPassword">Konfirmasi Password</label>

                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                        </div>
                    </div>
                </form>

                <div class="divider">atau daftar dengan</div>

                <a class="social-btn w-100" href="/auth/google/redirect">
                    <i class="fab fa-google text-danger"></i> Lanjutkan dengan Google
                </a>

                <div class="login-link">
                    Sudah punya akun? <a href="/sign-in">Masuk disini</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
