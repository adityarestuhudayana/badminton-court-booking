# 🏸 Badminton Court Booking App (Laravel 11)

A web-based application to manage badminton court bookings — built with **Laravel 11**.

---

## 🚀 Features

- 🏸 Landing Page dengan daftar lapangan
- 📆 Detail Lapangan berdasarkan tanggal booking
- 👤 Registrasi & Login (manual dan Google)
- ✅ Verifikasi email sebelum booking atau dashboard
- 🛒 Sistem Booking & histori pemesanan
- 💳 Konfirmasi pembayaran per booking
- 📊 Admin Dashboard (statistik, tren booking & pendapatan)
- ⚙️ Manajemen Lapangan & Jadwal oleh Admin
- 📩 Email verifikasi & kirim ulang link
- 🔐 Proteksi role (admin/user) & akses hanya untuk user terverifikasi

---

## 🧩 Third-Party Libraries & Packages

| Package | Fungsi |
|--------|--------|
| [Laravel Socialite](https://laravel.com/docs/11.x/socialite) | Login menggunakan akun Google |
| [Midtrans Snap](https://docs.midtrans.com/docs/snap-overview) | Sistem pembayaran (QRIS, e-wallet, transfer, dll) |

---

## 🛠️ Installation Guide

Ikuti langkah-langkah di bawah untuk menjalankan aplikasi ini secara lokal.

### 1. Clone repository

```bash
git clone https://github.com/adityarestuhudayana/badminton-court-booking.git
cd badminton-court-booking
```

> Jika kamu menggunakan SSH:

```bash
git clone git@github.com:adityarestuhudayana/badminton-court-booking.git
```

---

### 2. Install dependencies

```bash
composer install
npm install && npm run dev
```

---

### 3. Setup environment file

```bash
cp .env.example .env
```

Edit `.env` sesuai kebutuhan (lihat contoh konfigurasi di bawah).

---

### 4. Generate app key

```bash
php artisan key:generate
```

---

### 5. Jalankan migrasi database

```bash
php artisan migrate
```

Jika kamu punya seeder:

```bash
php artisan db:seed
```

---

### 6. Jalankan server lokal

```bash
php artisan serve
```

Buka [http://localhost:8000](http://localhost:8000) di browser.

---

## ⚙️ Example .env Configuration

```env
# App
APP_NAME=BadmintonBooking
APP_ENV=local
APP_KEY=base64:...
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=badminton_booking
DB_USERNAME=root
DB_PASSWORD=

# Mail (contoh pakai Mailtrap)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="Badminton Booking"

# Google Login (Laravel Socialite)
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# Midtrans
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

---

## 👤 Author

**Aditya Restu Hudayana**  
📫 [GitHub](https://github.com/adityarestuhudayana)

---

## 📄 License

MIT — bebas digunakan dan dimodifikasi.
