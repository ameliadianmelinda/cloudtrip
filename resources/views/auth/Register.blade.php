<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CloudTrip</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
</head>
<body>
<div class="register-wrapper">
    <!-- Left Side - Promo -->
    <div class="promo-section">
        <div class="promo-content">
            <div class="logo-section">
                <div class="logo-icon">
                    <img src="{{ asset('images/logo.png') }}" alt="CloudTrip Logo" class="logo-img">
                </div>
                <div class="logo-text">CloudTrip</div>
            </div>

            <h1 class="promo-title">Mulai Petualangan Anda!</h1>
            <p class="promo-subtitle">Bergabung dengan ribuan traveler di CloudTrip</p>
            <p class="promo-description">
                Buat akun Anda dan dapatkan akses ke penawaran eksklusif, manajemen booking yang mudah, dan rekomendasi perjalanan yang dipersonalisasi khusus untuk Anda.
            </p>
        </div>
    </div>

    <!-- Right Side - Form -->
    <div class="form-section">
        <div class="form-container">
            <div class="form-header">
                <h2>Buat Akun Baru</h2>
                <p>Isi data Anda untuk memulai perjalanan</p>
            </div>

            @if ($errors->any())
            <div class="alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="Nama Lengkap"
                           required
                           autofocus>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="Alamat Email"
                           required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Password"
                           required
                           minlength="8">
                    <div class="password-requirements">
                        Minimal 8 karakter
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Konfirmasi Password"
                           required
                           minlength="8">
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang</button>
            </form>

            <div class="divider">
                <span>ATAU</span>
            </div>

            <div class="social-login">
                <button type="button" class="btn-social btn-google">
                    <i class="fab fa-google"></i>
                    Google
                </button>
                <button type="button" class="btn-social btn-facebook">
                    <i class="fab fa-facebook-f"></i>
                    Facebook
                </button>
            </div>

            <div class="signin-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
