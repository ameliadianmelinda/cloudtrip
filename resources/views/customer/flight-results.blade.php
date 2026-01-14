@extends(Auth::check() ? 'layout.Header-cust-auth' : 'layout.Header-cust')

@section('title', 'Flight Results - CloudTrip Travel Agency')

@push('styles')
<style>
    .flight-card {
        transition: background 0.3s, border-color 0.3s, transform 0.2s, box-shadow 0.3s;
        background: linear-gradient(145deg, #fff 0%, #fefefe 100%);
        border-radius: 0.75rem;
        border: 1px solid transparent;
        position: relative;
    }
    .flight-card:hover {
        background: linear-gradient(145deg, #fefbff 0%, #f8fafc 100%);
        border-color: rgba(99,102,241,0.2);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .flight-card:not(:last-child) { margin-bottom: 8px; }
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
<div class="bg-white w-full min-h-screen" style="padding-top:25px!important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        @if(isset($flights) && $flights->count() > 0)
        <div class="rounded-xl p-6 mb-0 border mt-6"
            style="background:linear-gradient(135deg,rgba(255,184,148,0.2) 0%,rgba(251,149,144,0.2) 25%,rgba(220,88,109,0.2) 50%,rgba(163,55,87,0.2) 75%,rgba(76,29,61,0.2) 100%);
                   border-color:rgba(220,88,109,0.15);">
            <h1 class="text-2xl font-normal text-black">
                Penerbangan ke {{ $flights->first()->bandaraTujuan->kota_bandara ?? $flights->first()->bandaraTujuan->nama_bandara ?? 'Tujuan' }}
            </h1>
        </div>
        @endif

        @if(isset($flights) && $flights->count() > 0)
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            @foreach($flights as $index => $flight)
            @php
                $departure = \Carbon\Carbon::parse($flight->tanggal_berangkat.' '.$flight->waktu_berangkat);
                $arrival = \Carbon\Carbon::parse($flight->tanggal_berangkat.' '.$flight->waktu_tiba);
                if ($arrival->lt($departure)) $arrival->addDay();
                $duration = $departure->diff($arrival);
                $depCode = $flight->bandaraAsal->kode_bandara;
                $arrCode = $flight->bandaraTujuan->kode_bandara;
                $airlineName = $flight->pesawat && $flight->pesawat->maskapai
                    ? $flight->pesawat->maskapai->nama_maskapai : 'Unknown Airline';
                $logoPath = $flight->pesawat && $flight->pesawat->maskapai
                    ? $flight->pesawat->maskapai->logo : null;
                $passengers = $searchData['passengers'] ?? 1;
            @endphp

            <div class="flight-card p-6 cursor-pointer"
                onclick="window.location.href='{{ route('flight.booking', ['id' => $flight->jadwal_id, 'passengers' => $passengers]) }}'">
                <div class="flex justify-start mb-6">
                    <div class="rounded-lg px-4 py-2 border-0" style="background-color:#E0F7FA;">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="#0891B2" viewBox="0 0 24 24">
                                <path d="M9.5 2A1.5 1.5 0 0 0 8 3.5V5H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4V3.5A1.5 1.5 0 0 0 14.5 2h-5zM10 5h4V3.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V5zM4 7h16v12H4V7z"/>
                                <rect x="6" y="9" width="2" height="8" rx="1"/>
                                <rect x="11" y="9" width="2" height="8" rx="1"/>
                                <rect x="16" y="9" width="2" height="8" rx="1"/>
                            </svg>
                            <svg class="w-5 h-5" fill="#0891B2" viewBox="0 0 24 24">
                                <path d="M17 6h-2V3a1 1 0 0 0-1-1H10a1 1 0 0 0-1 1v3H7a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2zM11 4h2v2h-2V4zM7 8h10v11H7V8z"/>
                                <circle cx="9" cy="12" r="1"/>
                                <circle cx="15" cy="12" r="1"/>
                                <path d="M8 15h8v1H8z"/>
                            </svg>
                            <span class="font-medium text-sm" style="color:#0891B2;">Included</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-8 flex-1">
                        <div class="flex flex-col items-center text-center min-w-fit">
                            @if($logoPath && file_exists(public_path($logoPath)))
                                <img src="{{ asset($logoPath) }}" alt="{{ $airlineName }}" class="airline-logo mb-3">
                            @else
                                <div class="h-14 w-24 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mb-3 border border-blue-200">
                                    <span class="text-blue-700 font-bold text-xs text-center leading-tight px-1">
                                        {{ strtoupper(substr($airlineName,0,4)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-8 flex-1 justify-center">
                            <div class="text-center">
                                <div class="font-bold text-gray-900 bg-yellow-100 px-3 py-1 rounded-lg" style="font-size:25px;">
                                    {{ $departure->format('H:i') }}
                                </div>
                                <div class="font-semibold text-gray-600" style="font-size:16px;">
                                    {{ $depCode }}
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-2 px-6">
                                <div class="flex items-center gap-1">
                                    <div style="width:80px;height:2px;background-image:repeating-linear-gradient(to right,#9ca3af 0,#9ca3af 8px,transparent 8px,transparent 16px);"></div>
                                    <span class="text-gray-500 text-lg font-bold">></span>
                                </div>
                                <div class="text-gray-600 font-medium text-sm whitespace-nowrap px-3">
                                    {{ $duration->h }}h {{ $duration->i }}m
                                </div>
                                <div class="flex items-center gap-1">
                                    <div style="width:80px;height:2px;background-image:repeating-linear-gradient(to right,#9ca3af 0,#9ca3af 8px,transparent 8px,transparent 16px);"></div>
                                    <span class="text-gray-500 text-lg font-bold">></span>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="font-bold text-gray-900 bg-yellow-100 px-3 py-1 rounded-lg" style="font-size:25px;">
                                    {{ $arrival->format('H:i') }}
                                </div>
                                <div class="font-semibold text-gray-600" style="font-size:16px;">
                                    {{ $arrCode }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <div class="font-bold text-gray-700 bg-green-100 px-3 py-1 rounded-lg" style="font-size:25px;">
                                Rp {{ number_format($flight->harga,0,',','.') }}
                            </div>
                            <div class="text-base text-gray-600 font-medium">
                                {{ session('trip_type') === 'round_trip' ? 'Round Trip' : 'One Way' }}
                            </div>
                        </div>
                        <a href="{{ route('flight.booking', ['id' => $flight->jadwal_id, 'passengers' => $passengers]) }}"
                            class="inline-block px-8 py-2 rounded-full font-medium text-base transition-all min-w-fit text-gray-700 no-underline"
                            style="background:linear-gradient(135deg,rgba(255,184,148,0.2) 0%,rgba(251,149,144,0.2) 25%,rgba(220,88,109,0.2) 50%,rgba(163,55,87,0.2) 75%,rgba(76,29,61,0.2) 100%);
                                   border:1px solid rgba(220,88,109,0.15);"
                            onmouseover="this.style.background='linear-gradient(135deg,rgba(255,184,148,0.3) 0%,rgba(251,149,144,0.3) 25%,rgba(220,88,109,0.3) 50%,rgba(163,55,87,0.3) 75%,rgba(76,29,61,0.3) 100%)'"
                            onmouseout="this.style.background='linear-gradient(135deg,rgba(255,184,148,0.2) 0%,rgba(251,149,144,0.2) 25%,rgba(220,88,109,0.2) 50%,rgba(163,55,87,0.2) 75%,rgba(76,29,61,0.2) 100%)'">
                            Select
                        </a>
                    </div>
                </div>
            </div>
            @if(!$loop->last)
            <div class="divider-line"></div>
            @endif
        @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center px-6" style="padding-top:150px;">
            <div class="relative mb-10" style="width:400px;height:260px;">
                <div class="absolute bg-gray-100 rounded-xl border border-gray-200 shadow-sm"
                    style="width:260px;height:160px;top:0;right:0;transform:rotate(10deg);">
                    <div class="p-4">
                        <div class="flex gap-2 mb-3">
                            <div class="w-20 h-3.5 bg-gray-200 rounded"></div>
                            <div class="w-12 h-3.5 bg-gray-200 rounded ml-auto"></div>
                        </div>
                        <div class="w-full h-3 bg-gray-200 rounded mb-2"></div>
                        <div class="w-3/4 h-3 bg-gray-200 rounded"></div>
                    </div>
                </div>
                <div class="absolute bg-gray-50 rounded-xl border border-gray-200 shadow-sm"
                    style="width:280px;height:175px;top:30px;left:0;transform:rotate(-8deg);">
                    <div class="p-4">
                        <div class="flex gap-2 mb-3">
                            <div class="w-24 h-4 bg-gray-200 rounded"></div>
                            <div class="w-14 h-4 bg-gray-200 rounded ml-auto"></div>
                        </div>
                        <div class="w-full h-3 bg-gray-200 rounded mb-2"></div>
                        <div class="w-4/5 h-3 bg-gray-200 rounded mb-2"></div>
                        <div class="w-2/3 h-3 bg-gray-200 rounded"></div>
                    </div>
                </div>
                <div class="absolute bg-white rounded-xl border border-gray-200 shadow-md"
                    style="width:300px;height:190px;top:60px;left:50%;transform:translateX(-50%);">
                    <div class="p-5">
                        <div class="flex gap-2 mb-4">
                            <div class="w-28 h-4 bg-gray-300 rounded"></div>
                            <div class="w-16 h-4 bg-gray-200 rounded ml-auto"></div>
                        </div>
                        <div class="w-full h-3.5 bg-gray-200 rounded mb-2.5"></div>
                        <div class="w-full h-3.5 bg-gray-200 rounded mb-2.5"></div>
                        <div class="w-3/4 h-3.5 bg-gray-200 rounded mb-4"></div>
                        <div class="flex gap-3">
                            <div class="w-20 h-3.5 bg-gray-300 rounded"></div>
                            <div class="w-20 h-3.5 bg-gray-200 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-gray-500 text-lg mb-6">Tidak ada jadwal penerbangan yang tersedia</p>
            <a href="{{ route('homepage') }}"
                class="inline-flex items-center gap-2 px-6 py-3 text-white text-sm font-medium rounded-full transition-all duration-300 hover:shadow-xl hover:scale-105"
                style="background:linear-gradient(135deg,rgba(255,184,148,0.7) 0%,rgba(251,149,144,0.7) 25%,rgba(220,88,109,0.7) 50%,rgba(163,55,87,0.7) 75%,rgba(76,29,61,0.7) 100%);"
                onmouseover="this.style.background='linear-gradient(135deg,rgba(255,184,148,0.9) 0%,rgba(251,149,144,0.9) 25%,rgba(220,88,109,0.9) 50%,rgba(163,55,87,0.9) 75%,rgba(76,29,61,0.9) 100%)'"
                onmouseout="this.style.background='linear-gradient(135deg,rgba(255,184,148,0.7) 0%,rgba(251,149,144,0.7) 25%,rgba(220,88,109,0.7) 50%,rgba(163,55,87,0.7) 75%,rgba(76,29,61,0.7) 100%)'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
