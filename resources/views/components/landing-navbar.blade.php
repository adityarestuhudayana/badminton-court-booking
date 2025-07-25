@php
    if (auth()->user()) {
        $profileImage = auth()->user()->profile_image_url;
        $isUploadedPhotos = Str::substr($profileImage, 0, 11) === 'user_photos';
        $imgSrc = $isUploadedPhotos ? '/storage/' . $profileImage : asset($profileImage);
    }
@endphp


<nav class="navbar navbar-expand-md bg-white shadow-sm sticky-top">
    <div class="container">
        <!-- Logo dan Brand -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/429c1af0-bd9a-4c32-95e4-c8809e8b04e8.png"
                alt="Logo" class="me-2" height="32">
            <strong class="text-dark">BadmintonGo</strong>
        </a>

        <!-- Burger menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/#lapangan">Lapangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/#tentang">Tentang</a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $imgSrc }}" class="rounded-circle me-2" width="32" height="32"
                                alt="Foto profil pengguna">
                            <span class="d-none d-md-inline">Hi,
                                {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                            <li><a class="dropdown-item" href="/dashboard/booking-history">Booking Saya</a></li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Keluar</button>
                            </form>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill" href="/sign-in">Login</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
