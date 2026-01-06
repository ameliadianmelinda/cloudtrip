<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CloudTrip</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
<div class="login-wrapper">
    <!-- Left Side - Promo -->
    <div class="promo-section">
        <div class="promo-content">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-cloud"></i>
                </div>
                <div class="logo-text">CloudTrip</div>
            </div>
            
            <h1 class="promo-title">Jelajahi Dunia Bersama CloudTrip</h1>
            <p class="promo-subtitle">Platform Pemesanan Tiket Pesawat Terpercaya</p>
            <p class="promo-description">
                Pesan tiket pesawat dengan mudah dan cepat. Nikmati berbagai pilihan maskapai, harga terbaik, dan proses booking yang simple untuk perjalanan impian Anda.
            </p>
        </div>
    </div>
    
    <!-- Right Side - Form -->
    <div class="form-section">
        <div class="form-container">
            <div class="form-header">
                <h2>Selamat Datang Kembali</h2>
                <p>Login untuk melanjutkan perjalanan Anda</p>
            </div>

            @if ($errors->any())
            <div class="alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <input type="email" 
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" 
                           placeholder="Email"
                           required 
                           autofocus>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" 
                           name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Password"
                           required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <a href="#" class="forgot-link">Lupa Password?</a>

                <button type="submit" class="btn-login">Masuk</button>
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

            <div class="signup-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
