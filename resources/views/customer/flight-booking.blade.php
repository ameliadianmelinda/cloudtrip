@extends(Auth::check() ? 'layout.Header-cust-auth' : 'layout.Header-cust')

@section('title', 'Booking Flight - CloudTrip Travel Agency')

@push('styles')
<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* Ensure sticky positioning works properly */
    .sticky-sidebar {
        position: sticky;
        top: 6rem;
        max-height: calc(100vh - 8rem);
        overflow-y: auto;
    }

    /* Add smooth scrolling for better UX */
    html {
        scroll-behavior: smooth;
    }

    /* Custom dropdown styling with better spacing */
    .custom-select {
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        padding-right: 40px !important;
    }

    /* Force focus border style */
    input[type="text"]:focus,
    select:focus {
        border-color: rgba(0, 0, 0, 0.7) !important;
        box-shadow: none !important;
        outline: none !important;
    }

    /* Force hover border style */
    input[type="text"]:hover,
    select:hover {
        border-color: rgba(0, 0, 0, 0.7) !important;
    }
</style>
@endpush

@section('content')
@php
    $departure = \Carbon\Carbon::parse($flight->tanggal_berangkat.' '.$flight->waktu_berangkat);
    $arrival = \Carbon\Carbon::parse($flight->tanggal_berangkat.' '.$flight->waktu_tiba);
    if ($arrival->lt($departure)) $arrival->addDay();
    $duration = $departure->diff($arrival);

    $depCode = $flight->bandaraAsal->kode_bandara;
    $arrCode = $flight->bandaraTujuan->kode_bandara;

    $depCity = $flight->bandaraAsal->nama_kota;
    $arrCity = $flight->bandaraTujuan->nama_kota;

    $airlineName = $flight->pesawat && $flight->pesawat->maskapai
        ? $flight->pesawat->maskapai->nama_maskapai
        : 'Unknown Airline';

    $logoPath = $flight->pesawat && $flight->pesawat->maskapai
        ? $flight->pesawat->maskapai->logo
        : null;
@endphp

<div class="bg-gray-50 min-h-screen py-8 mt-6" style="margin-top: 24px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div style="display: flex; gap: 24px;">
            <!-- Left Section - Contact Details Form (60%) -->
            <div style="flex: 1; max-width: 60%;">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Detail Kontak E-ticket</h2>

                        <!-- Logged in User Info - Full Width -->
                        <div class="flex items-center gap-3 py-3 px-6 -mx-6 mb-6"
                             style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.2) 0%, rgba(251, 149, 144, 0.2) 25%, rgba(220, 88, 109, 0.2) 50%, rgba(163, 55, 87, 0.2) 75%, rgba(76, 29, 61, 0.2) 100%); border-top: 1px solid rgba(220, 88, 109, 0.15); border-bottom: 1px solid rgba(220, 88, 109, 0.15); margin-left: -24px; margin-right: -24px;">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center"
                                 style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.8) 0%, rgba(251, 149, 144, 0.8) 25%, rgba(220, 88, 109, 0.8) 50%, rgba(163, 55, 87, 0.8) 75%, rgba(76, 29, 61, 0.8) 100%);">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            @if(Auth::check())
                                <span class="text-gray-700 font-medium">Masuk sebagai {{ Auth::user()->email }}</span>
                            @else
                                <span class="text-gray-700 font-medium">Anda blm login? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 underline">Login disini!</a></span>
                            @endif
                        </div>

                    <form class="space-y-8" method="POST" action="{{ route('booking.store') }}">
                        @csrf
                        <input type="hidden" name="flight_id" value="{{ $flight->jadwal_id }}">
                        <!-- Error Messages Container -->
                        <div id="errorContainer" class="hidden" style="background: #fee; border: 1px solid #fee; border-left: 4px solid #e74c3c; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px; font-size: 14px; color: #e74c3c;">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle" style="margin-right: 12px;"></i>
                                <span id="errorList"></span>
                            </div>
                        </div>

                        <!-- Nama Penumpang -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-0.5">
                                Nama Penumpang<span class="text-red-500 ml-1">*</span>
                            </label>
                            <p class="text-xs text-gray-400 mb-2" style="font-size: 11px;">Sesuai KTP/Passport/SIM (tanpa gelar atau karakter khusus)</p>
                            <input type="text" name="nama_penumpang"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg hover:border-black hover:border-opacity-30 focus:ring-0 focus:border-black focus:border-opacity-30 transition-colors mb-4"
                                   placeholder="Masukkan nama lengkap penumpang"
                                   required>
                        </div>

                        <!-- NIK -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-0.5">
                                NIK (Nomor Induk Kependudukan)<span class="text-red-500 ml-1">*</span>
                            </label>
                            <p class="text-xs text-gray-400 mb-2" style="font-size: 11px;">16 digit nomor KTP</p>
                            <input type="text" name="nik" maxlength="16"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg hover:border-black hover:border-opacity-30 focus:ring-0 focus:border-black focus:border-opacity-30 transition-colors mb-4"
                                   placeholder="Masukkan Nomor Induk Kependudukan"
                                   required>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-0.5">
                                Tanggal Lahir<span class="text-red-500 ml-1">*</span>
                            </label>
                            <p class="text-xs text-gray-400 mb-2" style="font-size: 11px;">Penumpang Dewasa (Usia 12 tahun ke atas)</p>
                            <div class="flex gap-3 mb-4">
                                <div class="flex-1">
                                    <select name="birth_day"
                                            class="custom-select appearance-none w-full px-4 py-3 border border-gray-300 rounded-lg hover:border-black hover:border-opacity-30 focus:ring-0 focus:border-black focus:border-opacity-30 transition-colors text-gray-600" required>
                                        <option value="">DD</option>
                                        @for($i = 1; $i <= 31; $i++)
                                            <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="flex-2">
                                    <select name="birth_month"
                                            class="custom-select appearance-none w-full px-4 py-3 border border-gray-300 rounded-lg hover:border-black hover:border-opacity-30 focus:ring-0 focus:border-black focus:border-opacity-30 transition-colors text-gray-600" required>
                                        <option value="">MMMM</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <select name="birth_year"
                                            class="custom-select appearance-none w-full px-4 py-3 border border-gray-300 rounded-lg hover:border-black hover:border-opacity-30 focus:ring-0 focus:border-black focus:border-opacity-30 transition-colors text-gray-600" required>
                                        <option value="">YYYY</option>
                                        @for($year = 2024; $year >= 1930; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Jenis Kelamin<span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="jenis_kelamin"
                                    class="custom-select appearance-none w-full px-4 py-3 border border-gray-300 rounded-lg hover:border-black hover:border-opacity-30 focus:ring-0 focus:border-black focus:border-opacity-30 transition-colors text-gray-600 mb-4" required>
                                <option value="">Pilih jenis kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-8">
                            <button type="submit"
                                    id="continueToPaymentBtn"
                                    class="px-8 py-3 text-white font-semibold text-base rounded-full transition-all duration-300 {{ Auth::check() ? 'hover:scale-105 hover:shadow-lg hover:shadow-pink-200' : 'opacity-50 cursor-not-allowed' }}"
                                    style="background: {{ Auth::check() ? 'linear-gradient(135deg, #ffb894 0%, #fb9590 25%, #dc586d 50%, #a33757 75%, #4c1d3d 100%);' : 'linear-gradient(135deg, #d1d5db 0%, #9ca3af 50%, #6b7280 100%);' }}"
                                    {{ Auth::check() ? '' : 'disabled' }}
                                    @if(Auth::check())
                                        onmouseover="this.style.background='linear-gradient(135deg, #ff9f7a 0%, #fa7b76 25%, #d14553 50%, #932d43 75%, #3d1629 100%)'"
                                        onmouseout="this.style.background='linear-gradient(135deg, #ffb894 0%, #fb9590 25%, #dc586d 50%, #a33757 75%, #4c1d3d 100%)'"
                                    @endif>
                                {{ Auth::check() ? 'Lanjutkan ke Pembayaran' : 'Login untuk Melanjutkan' }}
                            </button>
                        </div>
                    </form>
                    </div>
                </div>

                <!-- Baggage Information Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden" style="margin-top: 32px;">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Informasi Bagasi</h2>

                        <div class="space-y-4">
                            <!-- Cabin Baggage -->
                            <div class="border border-gray-200 rounded-lg p-6 bg-gray-50">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color: #fed7aa; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);">
                                        <i class="fas fa-suitcase" style="color: #fb923c; font-size: 14px;"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-900">Bagasi Kabin</h3>
                                </div>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex items-start gap-2">
                                        <span class="text-orange-600 font-medium">•</span>
                                        <span>Berat maksimum: 7 kg per penumpang</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-orange-600 font-medium">•</span>
                                        <span>Dimensi maksimum: 56cm x 36cm x 23cm</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-orange-600 font-medium">•</span>
                                        <span>Harus muat di kompartemen atas</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Checked Baggage -->
                            <div class="border border-gray-200 rounded-lg p-6 bg-gray-50">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color: #bfdbfe; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);">
                                        <i class="fas fa-suitcase-rolling" style="color: #60a5fa; font-size: 14px;"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-900">Bagasi Tercatat</h3>
                                </div>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex items-start gap-2">
                                        <span class="text-blue-600 font-medium">•</span>
                                        <span>Bagasi gratis: 20 kg per penumpang</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-blue-600 font-medium">•</span>
                                        <span>Berat maksimum per tas: 32 kg</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-blue-600 font-medium">•</span>
                                        <span>Biaya bagasi berlebih berlaku untuk barang berlebihan</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Prohibited Items -->
                            <div class="border border-gray-200 rounded-lg p-6 bg-gray-50">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color: #fecaca; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);">
                                        <i class="fas fa-ban" style="color: #f87171; font-size: 14px;"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-900">Barang Terlarang</h3>
                                </div>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex items-start gap-2">
                                        <span class="text-red-600 font-medium">•</span>
                                        <span>Cairan lebih dari 100ml di bagasi kabin</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-red-600 font-medium">•</span>
                                        <span>Benda tajam dan alat-alat</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-red-600 font-medium">•</span>
                                        <span>Bahan mudah terbakar dan berbahaya</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section - Flight Summary & Price (40%) -->
            <div style="flex: 1; max-width: 40%;">
                <div class="sticky-sidebar space-y-6">
                    <!-- Flight Summary -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Detail Penerbangan</h3>
                        </div>

                        <!-- White Card Container -->
                        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                            <!-- Flight Route -->
                            <div class="space-y-4">
                                <!-- Depart Label -->
                                <div class="text-sm font-medium text-gray-600">Berangkat</div>

                                <!-- Flight Path -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-xl font-bold text-gray-900">({{ $depCode }})</div>
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <span class="text-lg">------></span>
                                        <span class="text-sm font-medium">{{ $duration->h }}h {{ $duration->i }}m</span>
                                        <span class="text-lg">------></span>
                                    </div>
                                    <div class="text-xl font-bold text-gray-900">({{ $arrCode }})</div>
                                </div>

                                <!-- Date and Time -->
                                <div class="flex justify-between text-sm text-gray-500 mb-6">
                                    <div class="text-left">
                                        <div>{{ $departure->format('D, d M Y') }}</div>
                                        <div class="font-bold text-gray-900 text-lg">{{ $departure->format('H:i') }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div>{{ $arrival->format('D, d M Y') }}</div>
                                        <div class="font-bold text-gray-900 text-lg">{{ $arrival->format('H:i') }}</div>
                                    </div>
                                </div>

                                <!-- Airline Logo -->
                                <div class="flex items-center justify-start">
                                    @if($logoPath && file_exists(public_path('images/' . $logoPath)))
                                        <img src="{{ asset('images/' . $logoPath) }}" alt="{{ $airlineName }}" class="h-8 max-w-[100px] object-contain">
                                    @else
                                        <div class="w-8 h-8 bg-blue-100 rounded flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price Details -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6" style="background-color: white !important; margin-top: 24px;">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Detail Harga</h3>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Harga yang dibayar</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-xl font-bold text-orange-600">Rp {{ number_format($flight->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
