@extends(Auth::check() ? 'layout.Header-cust-auth' : 'layout.Header-cust')

@section('title', 'Flight Results - CloudTrip Travel Agency')

@push('styles')
<style>
    .flight-card {
        transition: background 0.3s ease, border-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        background: linear-gradient(145deg, #ffffff 0%, #fefefe 100%);
        border-radius: 0.75rem;
        border: 1px solid transparent;
        position: relative;
    }
    .flight-card:hover {
        background: linear-gradient(145deg, #fefbff 0%, #f8fafc 100%);
        border-color: rgba(99, 102, 241, 0.2);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .flight-card:not(:last-child) {
        margin-bottom: 8px;
    }
    .airline-logo {
        max-height: 56px;
        max-width: 96px;
        object-fit: contain;
    }
    .divider-line {
        background: linear-gradient(90deg, transparent 0%, #d1d5db 15%, #d1d5db 85%, transparent 100%);
        height: 1px;
        margin: 16px 24px;
        opacity: 0.6;
    }
</style>
@endpush

@section('content')
<div class="bg-white w-full min-h-screen" style="padding-top: 25px !important;">
    <div class="max-w-6xl mx-auto px-4 pb-8">
        <!-- Header Section -->
        <div class="rounded-xl p-6 mb-0 border mt-6"
             style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.2) 0%, rgba(251, 149, 144, 0.2) 25%, rgba(220, 88, 109, 0.2) 50%, rgba(163, 55, 87, 0.2) 75%, rgba(76, 29, 61, 0.2) 100%);
                    border-color: rgba(220, 88, 109, 0.15);">
            <h1 class="text-2xl font-normal text-black">
                @if(isset($flights) && $flights->count() > 0)
                    Penerbangan ke {{ $flights->first()->bandaraTujuan->kota_bandara ?? $flights->first()->bandaraTujuan->nama_bandara ?? 'Tujuan' }}
                @elseif(isset($destination))
                    Penerbangan ke {{ $destination }}
                @else
                    Hasil Pencarian Penerbangan
                @endif
            </h1>
        </div>

        <!-- Flight Cards Container -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            @forelse($flights as $index => $flight)
                @php
                    $departure = \Carbon\Carbon::parse($flight->tanggal_berangkat.' '.$flight->waktu_berangkat);
                    $arrival   = \Carbon\Carbon::parse($flight->tanggal_berangkat.' '.$flight->waktu_tiba);
                    if ($arrival->lt($departure)) $arrival->addDay();
                    $duration = $departure->diff($arrival);

                    // Get airport codes from loaded relations
                    $depCode = $flight->bandaraAsal->kode_bandara;
                    $arrCode = $flight->bandaraTujuan->kode_bandara;

                    // Get airline name and logo from loaded relations
                    $airlineName = $flight->pesawat && $flight->pesawat->maskapai
                        ? $flight->pesawat->maskapai->nama_maskapai
                        : 'Unknown Airline';

                    $logoPath = $flight->pesawat && $flight->pesawat->maskapai
                        ? $flight->pesawat->maskapai->logo
                        : null;
                @endphp

                <!-- Flight Card -->
                <div class="flight-card p-6 cursor-pointer"
                     onclick="window.location.href='{{ route('flight.booking', $flight->jadwal_id) }}'">
                    <!-- Included Badge -->
                    <div class="flex justify-start mb-6">
                        <div class="rounded-lg px-4 py-2 border-0" style="background-color: #E0F7FA;">
                            <div class="flex items-center gap-2">
                                <!-- Suitcase/Luggage Icon -->
                                <svg class="w-5 h-5" fill="#0891B2" viewBox="0 0 24 24">
                                    <path d="M9.5 2A1.5 1.5 0 0 0 8 3.5V5H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4V3.5A1.5 1.5 0 0 0 14.5 2h-5zM10 5h4V3.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V5zM4 7h16v12H4V7z"/>
                                    <rect x="6" y="9" width="2" height="8" rx="1"/>
                                    <rect x="11" y="9" width="2" height="8" rx="1"/>
                                    <rect x="16" y="9" width="2" height="8" rx="1"/>
                                </svg>

                                <!-- Baggage/Bag Icon -->
                                <svg class="w-5 h-5" fill="#0891B2" viewBox="0 0 24 24">
                                    <path d="M17 6h-2V3a1 1 0 0 0-1-1H10a1 1 0 0 0-1 1v3H7a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2zM11 4h2v2h-2V4zM7 8h10v11H7V8z"/>
                                    <circle cx="9" cy="12" r="1"/>
                                    <circle cx="15" cy="12" r="1"/>
                                    <path d="M8 15h8v1H8z"/>
                                </svg>

                                <span class="font-medium text-sm" style="color: #0891B2;">
                                    Included
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Flight Details Row -->
                    <div class="flex items-center justify-between">
                        <!-- Left Section: Airline Logo, Name and Flight Info -->
                        <div class="flex items-center gap-8 flex-1">
                            <!-- Airline Logo and Name -->
                            <div class="flex flex-col items-center text-center min-w-fit">
                                @if($logoPath && file_exists(public_path('images/' . $logoPath)))
                                    <!-- Logo dari file -->
                                    <img src="{{ asset('images/' . $logoPath) }}"
                                         alt="{{ $airlineName }}"
                                         class="airline-logo mb-3">
                                @else
                                    <!-- Fallback box untuk semua maskapai yang tidak punya logo -->
                                    <div class="h-14 w-24 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mb-3 border border-blue-200">
                                        <span class="text-blue-700 font-bold text-xs text-center leading-tight px-1">
                                            {{ strtoupper(substr($airlineName, 0, 4)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <!-- Flight Route Information -->
                            <div class="flex items-center gap-8 flex-1 justify-center">
                                <!-- Departure -->
                                <div class="text-center">
                                    <div class="font-bold text-gray-900 bg-yellow-100 px-3 py-1 rounded-lg" style="font-size: 25px;">
                                        {{ $departure->format('H:i') }}
                                    </div>
                                    <div class="font-semibold text-gray-600" style="font-size: 16px;">
                                        {{ $depCode }}
                                    </div>
                                </div>

                                <!-- Flight Duration with Dashed Line -->
<div class="flex items-center justify-center gap-2 px-6">
    <!-- Left dashed line with arrow -->
    <div class="flex items-center gap-1">
        <div style="width: 80px; height: 2px; background-image: repeating-linear-gradient(to right, #9ca3af 0, #9ca3af 8px, transparent 8px, transparent 16px);"></div>
        <span class="text-gray-500 text-lg font-bold">></span>
    </div>

    <!-- Duration -->
    <div class="text-gray-600 font-medium text-sm whitespace-nowrap px-3">
        {{ $duration->h }}h {{ $duration->i }}m
    </div>

    <!-- Right dashed line with arrow -->
    <div class="flex items-center gap-1">
        <div style="width: 80px; height: 2px; background-image: repeating-linear-gradient(to right, #9ca3af 0, #9ca3af 8px, transparent 8px, transparent 16px);"></div>
        <span class="text-gray-500 text-lg font-bold">></span>
    </div>
</div>

                                <!-- Arrival -->
                                <div class="text-center">
                                    <div class="font-bold text-gray-900 bg-yellow-100 px-3 py-1 rounded-lg" style="font-size: 25px;">
                                        {{ $arrival->format('H:i') }}
                                    </div>
                                    <div class="font-semibold text-gray-600" style="font-size: 16px;">
                                        {{ $arrCode }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price and Button Section -->
                        <div class="flex items-center gap-6">
                            <!-- Price -->
                            <div class="text-right">
                                <div class="font-bold text-gray-700 bg-green-100 px-3 py-1 rounded-lg" style="font-size: 25px;">
                                    Rp {{ number_format($flight->harga, 0, ',', '.') }}
                                </div>
                                <div class="text-base text-gray-600 font-medium">
                                    {{ session('trip_type') === 'round_trip' ? 'Round Trip' : 'One Way' }}
                                </div>
                            </div>

                            <!-- Select Button -->
                            <a href="{{ route('flight.booking', $flight->jadwal_id) }}" class="inline-block px-8 py-2 rounded-full font-medium text-base transition-all min-w-fit text-gray-700 no-underline"
                                    style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.2) 0%, rgba(251, 149, 144, 0.2) 25%, rgba(220, 88, 109, 0.2) 50%, rgba(163, 55, 87, 0.2) 75%, rgba(76, 29, 61, 0.2) 100%);
                                           border: 1px solid rgba(220, 88, 109, 0.15);"
                                    onmouseover="this.style.background='linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%)'"
                                    onmouseout="this.style.background='linear-gradient(135deg, rgba(255, 184, 148, 0.2) 0%, rgba(251, 149, 144, 0.2) 25%, rgba(220, 88, 109, 0.2) 50%, rgba(163, 55, 87, 0.2) 75%, rgba(76, 29, 61, 0.2) 100%)'">
                                Select
                            </a>
                        </div>
                    </div>
                </div>

                @if(!$loop->last)
                    <!-- Enhanced Divider -->
                    <div class="divider-line"></div>
                @endif

            @empty
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Penerbangan</h3>
                    <p class="text-gray-600">Maaf, tidak ada penerbangan yang sesuai dengan kriteria pencarian Anda.</p>
                    <p class="text-sm text-gray-500 mt-2">Coba ubah tanggal atau rute penerbangan Anda.</p>
                    <a href="{{ route('homepage') }}" class="inline-block mt-4 px-6 py-3 rounded-lg font-medium transition-colors duration-200"
                       style="background: linear-gradient(135deg, #FFB894, #FB9590, #DC586D); color: white;">
                        Cari Penerbangan Baru
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
