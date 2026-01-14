@extends(Auth::check() ? 'layout.Header-cust-auth' : 'layout.Header-cust')

@section('title', 'Homepage - CloudTrip Travel Agency')

@push('styles')
<!-- Google Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .hero-section {
        background: linear-gradient(160deg, #FFF9F5 0%, #FFE8E5 30%, #F5E1EB 60%, #EDE4F3 100%);
        position: relative;
        overflow: hidden;
    }

    /* Decorative circles */
    .hero-section::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,182,193,0.3) 0%, transparent 70%);
        top: -100px;
        right: -100px;
        border-radius: 50%;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,218,185,0.4) 0%, transparent 70%);
        bottom: -50px;
        left: -50px;
        border-radius: 50%;
    }

    .hero-badge {
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.8);
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        animation: fadeInDown 0.8s ease-out, pulse 2s ease-in-out infinite;
    }

    .hero-title {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 700 !important;
        animation: fadeInUp 1s ease-out;
        text-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .hero-title-gradient {
        background: linear-gradient(135deg, #e07a5f 0%, #d4727a 50%, #c56c86 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-family: 'Poppins', sans-serif !important;
        font-weight: 700 !important;
    }

    .plane-container {
        position: relative;
        animation: float 4s ease-in-out infinite;
    }

    .plane-shadow {
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 200px;
        height: 30px;
        background: radial-gradient(ellipse, rgba(0,0,0,0.15) 0%, transparent 70%);
        animation: shadowPulse 4s ease-in-out infinite;
    }

    /* Floating clouds */
    .cloud {
        position: absolute;
        background: white;
        border-radius: 50px;
        opacity: 0.6;
        animation: cloudFloat 20s linear infinite;
    }

    .cloud::before, .cloud::after {
        content: '';
        position: absolute;
        background: white;
        border-radius: 50%;
    }

    .cloud-1 {
        width: 80px;
        height: 30px;
        top: 20%;
        left: -100px;
        animation-duration: 25s;
    }

    .cloud-2 {
        width: 60px;
        height: 25px;
        top: 40%;
        left: -80px;
        animation-duration: 30s;
        animation-delay: 5s;
    }

    .cloud-3 {
        width: 100px;
        height: 35px;
        top: 60%;
        left: -120px;
        animation-duration: 35s;
        animation-delay: 10s;
    }

    /* Stats cards */
    .stat-card {
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.9);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(-2deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
    }

    @keyframes shadowPulse {
        0%, 100% { transform: translateX(-50%) scale(1); opacity: 0.15; }
        50% { transform: translateX(-50%) scale(0.8); opacity: 0.1; }
    }

    @keyframes pulse {
        0%, 100% { box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        50% { box-shadow: 0 4px 30px rgba(224,122,95,0.2); }
    }

    @keyframes cloudFloat {
        from { transform: translateX(0); }
        to { transform: translateX(calc(100vw + 200px)); }
    }
</style>
@endpush

@section('content')

    <section class="hero-section py-16 relative">

        <div class="cloud cloud-1"></div>
        <div class="cloud cloud-2"></div>
        <div class="cloud cloud-3"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-8">

                <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl text-gray-800 mb-2 leading-tight">
                    Layanan Pemesanan Tiket
                </h1>
                <h2 class="hero-title text-4xl md:text-5xl lg:text-6xl mb-6">
                    <span class="hero-title-gradient">Pesawat Online</span>
                </h2>


                <p class="text-gray-500 text-lg max-w-xl mx-auto mb-8" style="animation: fadeInUp 1.2s ease-out;">
                    Temukan penerbangan terbaik dengan harga termurah
                </p>


                <div class="flex justify-center mb-6">
                    <div class="plane-container" style="width: 500px; height: 220px;">
                        <img src="{{ asset('images/pesawat.png') }}" alt="Airplane" class="w-full h-full object-contain drop-shadow-2xl">
                        <div class="plane-shadow"></div>
                    </div>
                </div>
            </div>

            <!-- Flight Search Form -->
            <div class="bg-white rounded-2xl shadow-lg p-6 max-w-4xl mx-auto relative z-40">

                <!-- Display validation errors -->
                @if($errors->any())
                    <div class="bg-red-50 border border-[#e53935] px-4 py-3 rounded-lg mb-4 flex items-center gap-3 shadow-sm">
                        <!-- Icon warning -->
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#e53935" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                        </svg>
                        <ul class="list-none m-0 p-0">
                            @foreach(collect($errors->all())->unique() as $error)
                                <li style="color:#e53935;font-weight:regular;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('search.flights') }}" method="POST" id="flightSearchForm">
                    @csrf
                    <input type="hidden" name="trip_type" id="tripType" value="one_way">

                    <div class="flex flex-wrap gap-2 items-center">
                        <!-- From -->
                        <div class="flex-1">
                            <label class="block text-xs text-gray-600 mb-1">Dari</label>
                            <div class="relative z-50">
                                <select name="from" class="w-full p-3 pr-12 pl-4 border @error('from') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white" required>
                                    <option value="">Pilih kota keberangkatan</option>
                                    @foreach($bandaras as $bandara)
                                        <option value="{{ $bandara->nama_bandara }}" {{ old('from') == $bandara->nama_bandara ? 'selected' : '' }}>{{ $bandara->nama_bandara }}, {{ $bandara->negara }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Swap Icon -->
                        <div class="flex-shrink-0 flex items-center justify-center" style="margin-top: 24px;">
                            <button type="button" id="swapBtn" class="h-14 w-14 rounded-full transition duration-300 hover:scale-105 hover:shadow-lg transform flex items-center justify-center"
                                    style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%);">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                            </button>
                        </div>

                        <!-- To -->
                        <div class="flex-1">
                            <label class="block text-xs text-gray-600 mb-1">Ke</label>
                            <div class="relative z-50">
                                <select name="to" class="w-full p-3 pr-12 pl-4 border @error('to') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white" required>
                                    <option value="">Pilih kota tujuan</option>
                                    @foreach($bandaras as $bandara)
                                        <option value="{{ $bandara->nama_bandara }}" {{ old('to') == $bandara->nama_bandara ? 'selected' : '' }}>{{ $bandara->nama_bandara }}, {{ $bandara->negara }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Departure -->
                        <div class="flex-1">
                            <label class="block text-xs text-gray-600 mb-1">Tanggal Keberangkatan</label>
                            <input type="date" name="departure_date" value="{{ old('departure_date', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+2 years')) }}" class="w-full p-3 border @error('departure_date') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>

                        <!-- Jumlah Penumpang -->
                        <div class="flex-1">
                            <label class="block text-xs text-gray-600 mb-1">Jumlah Penumpang</label>
                            <div class="relative z-50">
                                <select name="passengers" class="w-full p-3 pr-12 pl-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white" required>
                                    <option value="1" selected>1 Penumpang</option>
                                    <option value="2">2 Penumpang</option>
                                    <option value="3">3 Penumpang</option>
                                    <option value="4">4 Penumpang</option>
                                    <option value="5">5 Penumpang</option>
                                    <option value="6">6 Penumpang</option>
                                    <option value="7">7 Penumpang</option>
                                    <option value="8">8 Penumpang</option>
                                    <option value="9">9 Penumpang</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="flex-shrink-0 flex items-center justify-center" style="margin-top: 24px;">
                            <button type="submit" class="h-14 w-14 rounded-full transition-all duration-300 hover:scale-110 hover:shadow-xl transform flex items-center justify-center hover:shadow-pink-200 hover:bg-opacity-50"
                                    style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%);"
                                    onmouseover="this.style.background='linear-gradient(135deg, rgba(255, 184, 148, 0.6) 0%, rgba(251, 149, 144, 0.6) 25%, rgba(220, 88, 109, 0.6) 50%, rgba(163, 55, 87, 0.6) 75%, rgba(76, 29, 61, 0.6) 100%)'"
                                    onmouseout="this.style.background='linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%)'">
                                <svg class="w-6 h-6 text-gray-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Top Flight Deals Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Title -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">PENAWARAN PENERBANGAN TERBAIK</h2>
                <p class="text-gray-600">
                    Temukan penawaran penerbangan terbaik untuk pengalaman perjalanan<br>eksklusif dengan harga terjangkau.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 h-80">

                <!-- LEFT CARD (Luxury Travel Horizontal) -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden flex w-full lg:w-[45%] h-full">
                    <div class="w-[50%]">
                        <img src="{{ asset('images/kursi_pswt.jpg') }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="w-[50%] p-6 flex flex-col justify-center">
                        <p class="text-sm text-gray-500 mb-2 font-medium tracking-wider">DTOUR2023</p>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight">
                            PENERBANGAN MEWAH & MASKAPAI PREMIUM
                        </h3>

                        <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                            Rasakan pengalaman terbang berkelas dengan layanan maskapai premium yang mengutamakan kenyamanan dan eksklusivitas.
                        </p>

                        <button class="bg-blue-300 text-white px-6 py-2 rounded-full hover:bg-blue-400 transition">
                            Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>

                <!-- RIGHT COLUMN (2 vertical cards) -->
                <div class="flex flex-col lg:flex-row gap-6 w-full lg:w-[55%]">

                    <!-- HOTEL BOOKINGS -->
                    <div class="relative rounded-3xl shadow-lg overflow-hidden flex-1 h-full">
                        <img src="{{ asset('images/pesawat-1.jpg') }}"
                            class="absolute inset-0 w-full h-full object-cover">

                        <!-- gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                            <h3 class="text-white text-lg font-bold">PEMESANAN HOTEL</h3>

                            <button class="bg-blue-300 hover:bg-blue-200 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 17l9.2-9.2M17 17V7H7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- BOOK DOMESTIC -->
                    <div class="relative rounded-3xl shadow-lg overflow-hidden flex-1 h-full">
                        <img src="{{ asset('images/pesawat-2.jpg') }}"
                            class="absolute inset-0 w-full h-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                            <h3 class="text-white text-lg font-bold">PESAWAT DOMESTIK</h3>

                            <button class="bg-blue-300 hover:bg-blue-200 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 17l9.2-9.2M17 17V7H7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Most Popular Airlines Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">MASKAPAI PALING POPULER</h2>
                <p class="text-gray-600">Maskapai terkemuka dunia menawarkan layanan terbaik, memastikan<br>pengalaman perjalanan yang berkesan bagi penumpang.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                <!-- Singapore Airlines -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="h-28 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/pwt1.png') }}"
                             alt="Singapore Airlines"
                             class="w-24 h-24 object-cover group-hover:scale-110 transition-transform duration-300"
                             style="border-radius: 20px;">
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm">SINGAPORE AIRLINES</h3>
                    <p class="text-xs text-gray-500 mt-1">A Great Way to Fly</p>
                </div>

                <!-- Turkish Airlines -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="h-28 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/pwt2.png') }}"
                             alt="Turkish Airlines"
                             class="w-24 h-24 object-cover group-hover:scale-110 transition-transform duration-300"
                             style="border-radius: 20px;">
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm">TURKISH AIRLINES</h3>
                    <p class="text-xs text-gray-500 mt-1">Widen Your World</p>
                </div>

                <!-- Qatar Airways -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="h-28 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/pwt3.png') }}"
                             alt="Qatar Airways"
                             class="w-24 h-24 object-cover group-hover:scale-110 transition-transform duration-300"
                             style="border-radius: 20px;">
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm">QATAR AIRWAYS</h3>
                    <p class="text-xs text-gray-500 mt-1">Going Places Together</p>
                </div>

                <!-- Emirates -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="h-28 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/pwt4.png') }}"
                             alt="Emirates"
                             class="w-24 h-24 object-cover group-hover:scale-110 transition-transform duration-300"
                             style="border-radius: 20px;">
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm">EMIRATES</h3>
                    <p class="text-xs text-gray-500 mt-1">Fly Better</p>
                </div>

                <!-- Etihad Airways -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="h-28 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/pwt5.png') }}"
                             alt="Etihad Airways"
                             class="w-24 h-24 object-cover group-hover:scale-110 transition-transform duration-300"
                             style="border-radius: 20px;">
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm">ETIHAD AIRWAYS</h3>
                    <p class="text-xs text-gray-500 mt-1">Choose Well</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Book Your Hotel Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">PESAN HOTEL ANDA</h2>
                <p class="text-gray-600">Hotel terbaik menawarkan kenyamanan dan fasilitas lengkap untuk<br>pengalaman menginap yang tak terlupakan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Hotel 1 - Moxy NYC Downtown -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-200">
                    <div class="h-64 relative overflow-hidden">
                        <img src="{{ asset('images/hotel01.png') }}" alt="Moxy NYC Downtown" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold mb-2">MOXY NYC DOWNTOWN</h3>
                        </div>
                    </div>
                </div>

                <!-- Hotel 2 - Hotel Tropical Daisy -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-200">
                    <div class="h-64 relative overflow-hidden">
                        <img src="{{ asset('images/hotel02.png') }}" alt="Hotel Tropical Daisy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold mb-1">HOTEL TROPICAL DAISY</h3>
                            <button class="mt-2 bg-black text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800 transition duration-200">
                                Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hotel 3 - Hotel Tropical Daisy -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-200">
                    <div class="h-64 relative overflow-hidden">
                        <img src="{{ asset('images/hotel03.png') }}" alt="Hotel Tropical Daisy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold mb-2">HOTEL TROPICAL DAISY</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Get elements
    const swapBtn = document.getElementById('swapBtn');
    const fromSelect = document.querySelector('select[name="from"]');
    const toSelect = document.querySelector('select[name="to"]');

    // Function to swap from and to destinations
    function swapDestinations() {
        const fromValue = fromSelect.value;
        const toValue = toSelect.value;

        fromSelect.value = toValue;
        toSelect.value = fromValue;
    }

    // Add event listener for swap button
    swapBtn.addEventListener('click', swapDestinations);
</script>
@endpush
