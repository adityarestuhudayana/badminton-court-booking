@php
    $imageUrl = Str::startsWith($book->court->image_url, 'court_images')
        ? asset('storage/' . $book->court->image_url)
        : $book->court->image_url;
@endphp

<x-landing-layout>
    <div class="container payment-container">
        <div class="card payment-card">
            <div class="card-header text-center">
                <i class="fas fa-check-circle payment-icon"></i>
                <h2>Konfirmasi Pembayaran</h2>
                <div class="payment-status">
                    Menunggu Konfirmasi
                </div>
            </div>
            <div class="card-body payment-details">
                <!-- Informasi Pesanan -->
                <h5 class="mb-4">Detail Pesanan</h5>
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ $imageUrl }}" class="product-image">
                    <div class="product-info">
                        <h5>{{ $book->court->name }}</h5>
                        <small class="text-success"><i class="fas fa-check-circle me-1"></i> Lapangan tersedia</small>
                    </div>
                </div>

                <div class="detail-row total-row">
                    <span>Total Pembayaran</span>
                    <span>Rp {{ number_format($book->court->price, 0, ',', '.') }}</span>
                </div>

                <!-- Tombol Konfirmasi -->
                <div class="text-center mt-5">
                    <button class="btn btn-confirm" id="pay-button" data-snap-token="{{ $book->snap_token }}">Bayar
                        Sekarang</button>
                </div>

                <form action="/dashboard/books/{{ $book->id }}" method="post" class="text-center mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-danger bg-body border-0 text-center">Batalkan</button>
                </form>

                <!-- Catatan -->
                <p class="text-center text-muted mt-4 small">
                    <i class="fas fa-info-circle me-1"></i>
                    Pembayaran akan diverifikasi dalam waktu 1x24 jam. Pesanan akan diproses setelah pembayaran
                    dikonfirmasi.
                </p>
            </div>
        </div>
    </div>
</x-landing-layout>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
</script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        const snapToken = this.getAttribute('data-snap-token');

        snap.pay(snapToken, {
            onSuccess: function(result) {
                window.location.href = "/dashboard/booking-history";
            },
            onPending: function(result) {
                alert("Transaksi sedang diproses. Silakan selesaikan pembayaran.");
                // window.location.href = "/dashboard/booking-history";
            },
            onError: function(result) {
                alert(
                    "Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi atau gunakan metode pembayaran lain.");
            }
        });
    };
</script>
