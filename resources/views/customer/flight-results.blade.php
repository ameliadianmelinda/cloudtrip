@extends('layout.Header-cust')

@section('title', 'Flight Results - CloudTrip Travel Agency')

@section('content')
<section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Search Summary -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold">
                        {{ $searchData['from'] }} → {{ $searchData['to'] }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($searchData['departure_date'])->format('D, M j, Y') }}
                    </p>
                </div>
                <div class="text-sm text-gray-500">
                    {{ $flights->count() }} flights found
                </div>
            </div>
        </div>

        <!-- Flights -->
        <h3 class="text-xl font-bold mb-4">Available Flights</h3>

        @forelse($flights as $flight)

            @php
                $departure = \Carbon\Carbon::parse($flight->tanggal_berangkat.' '.$flight->waktu_berangkat);
                $arrival   = \Carbon\Carbon::parse($flight->tanggal_berangkat.' '.$flight->waktu_tiba);
                if ($arrival->lt($departure)) $arrival->addDay();
                $duration = $departure->diff($arrival);
            @endphp

            <div class="bg-white border rounded-xl p-6 mb-4 hover:shadow-md transition relative">

                <!-- Cheapest Badge -->
                <div class="absolute top-0 left-6 -translate-y-1/2">
                    <span class="bg-teal-600 text-white px-3 py-1 rounded text-xs font-medium">
                        Cheapest
                    </span>
                </div>

                <!-- Included Icons -->
                <div class="flex gap-4 text-sm text-gray-500 mb-6 mt-2">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M9 1L5 5l4 4"/>
                        </svg>
                        <span>Included</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Included</span>
                    </div>
                </div>

                <!-- Main Flight Info -->
                <div class="flex items-center justify-between">
                    
                    <!-- Airline Logo & Name -->
                    <div class="flex items-center gap-4 w-48">
                        <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $flight->nama_maskapai }}</p>
                        </div>
                    </div>

                    <!-- Flight Timeline -->
                    <div class="flex-1 px-8">
                        <!-- Duration -->
                        <div class="text-center mb-2">
                            <span class="text-sm text-gray-500">{{ $duration->h }}h {{ $duration->i }}m</span>
                        </div>
                        
                        <!-- Times and Route -->
                        <div class="flex items-center justify-between">
                            <!-- Departure -->
                            <div class="text-left">
                                <div class="text-3xl font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($flight->waktu_berangkat)->format('H:i') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    @php
                                        $asal = $flight->asal;
                                        if (strpos($asal, 'Jakarta') !== false) echo 'CGK T1B';
                                        elseif (strpos($asal, 'Bali') !== false || strpos($asal, 'Denpasar') !== false) echo 'DPS D';
                                        elseif (strpos($asal, 'Surabaya') !== false) echo 'SUB';
                                        elseif (strpos($asal, 'Soekarno') !== false) echo 'SOE';
                                        else echo strtoupper(substr($asal, 0, 3));
                                    @endphp
                                </div>
                            </div>

                            <!-- Line -->
                            <div class="flex-1 mx-8">
                                <div class="h-0.5 bg-gray-300"></div>
                            </div>

                            <!-- Arrival -->
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($flight->waktu_tiba)->format('H:i') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    @php
                                        $tujuan = $flight->tujuan;
                                        if (strpos($tujuan, 'Jakarta') !== false) echo 'CGK T1B';
                                        elseif (strpos($tujuan, 'Bali') !== false || strpos($tujuan, 'Denpasar') !== false) echo 'DPS D';
                                        elseif (strpos($tujuan, 'Surabaya') !== false) echo 'SUB';
                                        elseif (strpos($tujuan, 'Ngurah') !== false) echo 'NGU';
                                        else echo strtoupper(substr($tujuan, 0, 3));
                                    @endphp
                                </div>
                            </div>
                        </div>

                        <!-- Nonstop -->
                        <div class="text-center mt-2">
                            <span class="text-sm text-gray-500">Nonstop</span>
                        </div>
                    </div>

                    <!-- Price & Select -->
                    <div class="text-right w-56">
                        <div class="text-2xl font-bold text-gray-900 mb-1">
                            Rp {{ number_format($flight->harga, 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-500 mb-4">One-way</div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                            Select
                        </button>
                    </div>
                </div>

                <!-- Flight Details -->
                <div class="mt-4">
                    <button class="text-blue-600 text-sm hover:underline">
                        Flight details
                    </button>
                </div>

            </div>

        @empty
            <div class="bg-white p-8 text-center rounded-xl">
                <p class="text-gray-500">No flights found</p>
            </div>
        @endforelse

    </div>
</section>
@endsection
