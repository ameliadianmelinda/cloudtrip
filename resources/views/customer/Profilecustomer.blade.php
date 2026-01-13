@extends('layout.Header-cust-auth')
@section('title', 'Profile Customer - CloudTrip Travel Agency')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    @yield('content')
</body>

</html>

<div class="min-h-screen bg-gray-100 py-12 px-12">
    <div class="max-w-4xl mx-auto">
        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-lg p-12 mb-12">
            <div class="text-center">
                <!-- Avatar -->
                <div class="flex items-center justify-center mx-auto mb-6">
                    <div class="w-48 h-48 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-user text-8xl text-blue-900"></i>
                    </div>
                </div>

                <!-- Name -->
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ Auth::user()->name }}</h1>
                <p class="text-gray-600 text-base mb-4">Welcome back, traveler! ✈️</p>

                <!-- Email -->
                <p class="text-gray-700 text-sm mb-6">{{ Auth::user()->email }}</p>

                <!-- Logout Button -->
                <a id="logout-button" href="{{ route('logout') }}" class="inline-block px-8 py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition duration-200">
                    Logout
                </a>
            </div>
        </div>

        <!-- Riwayat Pemesanan Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Riwayat Pemesanan</h2>
            <p class="text-gray-600 text-sm mb-8">Kelola dan pantau semua pemesanan tiket pesawat Anda</p>

            @if(isset($pemesanan) && count($pemesanan) > 0)
            <div class="space-y-6">
                @foreach($pemesanan as $order)
                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-200">
                    <!-- Header Row -->
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $order->kode_pemesanan ?? 'N/A' }}</h3>
                            <p class="text-gray-600 text-sm mt-1">{{ $order->tanggal_pesan ? \Carbon\Carbon::parse($order->tanggal_pesan)->format('d M Y - H:i') : 'N/A' }}</p>
                        </div>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                @if($order->status === 'paid') bg-green-100 text-green-700
                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700
                                @endif">
                            {{ ucfirst($order->status ?? 'N/A') }}
                        </span>
                    </div>

                    <!-- Flight Route -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div class="text-center flex-1">
                                <p class="text-gray-600 text-xs font-semibold mb-2">FROM</p>
                                <p class="text-2xl font-bold text-gray-900">{{ substr($order->jadwal->bandaraAsal->nama_bandara ?? 'N/A', 0, 3) }}</p>
                                <p class="text-gray-600 text-xs mt-1">{{ $order->jadwal->bandaraAsal->nama_bandara ?? 'N/A' }}</p>
                            </div>
                            <div class="flex flex-col items-center mx-4">
                                <i class="fas fa-plane text-gray-400 text-xl transform -rotate-90 mb-2"></i>
                                <p class="text-gray-600 text-xs">{{ $order->jadwal ? \Carbon\Carbon::parse($order->jadwal->tanggal_berangkat)->format('M d') : 'N/A' }}</p>
                            </div>
                            <div class="text-center flex-1">
                                <p class="text-gray-600 text-xs font-semibold mb-2">TO</p>
                                <p class="text-2xl font-bold text-gray-900">{{ substr($order->jadwal->bandaraTujuan->nama_bandara ?? 'N/A', 0, 3) }}</p>
                                <p class="text-gray-600 text-xs mt-1">{{ $order->jadwal->bandaraTujuan->nama_bandara ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-4 gap-4 mb-4">
                        <div>
                            <p class="text-gray-600 text-xs font-semibold mb-1">AIRLINE</p>
                            <p class="text-gray-900 text-sm font-semibold">{{ $order->jadwal->pesawat && $order->jadwal->pesawat->maskapai ? $order->jadwal->pesawat->maskapai->nama_maskapai : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs font-semibold mb-1">DEPARTURE</p>
                            <p class="text-gray-900 text-sm font-semibold">{{ $order->jadwal->waktu_berangkat ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs font-semibold mb-1">DATE</p>
                            <p class="text-gray-900 text-sm font-semibold">{{ $order->jadwal ? \Carbon\Carbon::parse($order->jadwal->tanggal_berangkat)->format('d M Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs font-semibold mb-1">TOTAL</p>
                            <p class="text-blue-600 text-sm font-bold">Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button class="flex-1 px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition duration-200" onclick="showTicketDetail('{{ $order->pemesanan_id }}')">
                            View Details
                        </button>
                        @if($order->status === 'pending')
                        <a href="{{ route('payment.show', $order->pemesanan_id) }}" class="flex-1 text-center px-4 py-2 bg-green-500 text-white text-sm font-semibold rounded-lg hover:bg-green-600 transition duration-200">
                            Pay Now
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Ticket Detail Modal -->
                <div id="ticketModal-{{ $order->pemesanan_id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 max-h-96 overflow-y-auto">
                        <!-- Close Button -->
                        <div class="flex justify-end p-4 border-b">
                            <button onclick="closeTicketDetail()" class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-times text-2xl"></i>
                            </button>
                        </div>

                        <!-- Ticket Content -->
                        <div class="p-8">
                            <!-- Ticket Header -->
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-900">{{ __('Detail Tiket Penerbangan') }}</h2>
                                <p class="text-gray-600 text-sm mt-2">{{ __('Nomor Pemesanan: ') }}<span class="font-bold text-blue-600">{{ $order->kode_pemesanan ?? 'N/A' }}</span></p>
                            </div>

                            <!-- Ticket Design -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-8 border-2 border-blue-300">
                                <!-- Airline Header -->
                                <div class="flex justify-between items-center mb-6 pb-6 border-b-2 border-blue-300">
                                    <div>
                                        <p class="text-sm text-gray-600 font-semibold">{{ __('MASKAPAI') }}</p>
                                        <p class="text-2xl font-bold text-gray-900">{{ $order->jadwal->pesawat && $order->jadwal->pesawat->maskapai ? $order->jadwal->pesawat->maskapai->nama_maskapai : 'N/A' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-600">{{ __('BOARDING PASS') }}</p>
                                        <p class="text-lg font-bold text-blue-600">{{ $order->jadwal->pesawat && $order->jadwal->pesawat->maskapai ? substr($order->jadwal->pesawat->maskapai->nama_maskapai, 0, 2) : '' }}</p>
                                    </div>
                                </div>

                                <!-- Main Flight Info -->
                                <div class="flex justify-between items-center mb-8">
                                    <!-- Departure -->
                                    <div class="text-center">
                                        <p class="text-5xl font-bold text-gray-900 mb-2">{{ substr($order->jadwal->bandaraAsal->nama_bandara ?? 'N/A', 0, 3) }}</p>
                                        <p class="text-sm text-gray-700 font-semibold">{{ $order->jadwal->bandaraAsal->nama_bandara ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-600 mt-2">{{ $order->jadwal->waktu_berangkat ?? 'N/A' }}</p>
                                    </div>

                                    <!-- Flight Path -->
                                    <div class="flex-1 flex flex-col items-center mx-6">
                                        <div class="w-full flex items-center justify-between mb-2">
                                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                                            <div class="flex-1 h-1 bg-blue-400 mx-2"></div>
                                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                                        </div>
                                        <p class="text-xs text-gray-600 font-semibold">{{ $order->jadwal ? \Carbon\Carbon::parse($order->jadwal->tanggal_berangkat)->format('d M Y') : 'N/A' }}</p>
                                        <p class="text-xs text-gray-600 mt-1">{{ $order->jadwal ? ($order->jadwal->waktu_tiba ?? 'N/A') : 'N/A' }}</p>
                                    </div>

                                    <!-- Arrival -->
                                    <div class="text-center">
                                        <p class="text-5xl font-bold text-gray-900 mb-2">{{ substr($order->jadwal->bandaraTujuan->nama_bandara ?? 'N/A', 0, 3) }}</p>
                                        <p class="text-sm text-gray-700 font-semibold">{{ $order->jadwal->bandaraTujuan->nama_bandara ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-600 mt-2">{{ $order->jadwal ? ($order->jadwal->waktu_tiba ?? 'N/A') : 'N/A' }}</p>
                                    </div>
                                </div>

                                <!-- Passenger & Seat Info -->
                                <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b-2 border-blue-300">
                                    <div>
                                        <p class="text-xs text-gray-600 font-semibold">{{ __('NAMA PENUMPANG') }}</p>
                                        <p class="text-lg font-bold text-gray-900">{{ $order->detailPemesanan && $order->detailPemesanan->count() ? $order->detailPemesanan->pluck('penumpang.nama_penumpang')->implode(', ') : Auth::user()->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600 font-semibold">{{ __('REFERENSI BOOKING') }}</p>
                                        <p class="text-lg font-bold text-blue-600">{{ $order->kode_pemesanan ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600 font-semibold">{{ __('TOTAL HARGA') }}</p>
                                        <p class="text-lg font-bold text-green-600">Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <!-- Status Info -->
                                <div class="text-center">
                                    <span class="inline-block px-4 py-2 rounded-full text-sm font-bold
                                        @if($order->status === 'paid') bg-green-200 text-green-700
                                        @elseif($order->status === 'pending') bg-yellow-200 text-yellow-700
                                        @else bg-red-200 text-red-700
                                        @endif">
                                        <i class="fas fa-check-circle mr-2"></i>{{ ucfirst($order->status ?? 'N/A') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-16">
                <div class="text-5xl mb-4">📦</div>
                <p class="text-xl font-bold text-gray-900 mb-2">Belum Ada Riwayat Pemesanan</p>
                <p class="text-gray-600 text-sm mb-6">Mulai petualangan Anda! Cari dan pesan tiket pesawat sekarang</p>
                <a href="/" class="inline-block px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-200">
                    Cari Tiket
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- JavaScript untuk Modal -->
<script>
    function showTicketDetail(id) {
        const ticketModal = document.getElementById('ticketModal-' + id);
        if (ticketModal) {
            ticketModal.classList.remove('hidden');
        }
    }

    function closeTicketDetail() {
        const ticketModals = document.querySelectorAll('[id^="ticketModal-"]');
        ticketModals.forEach(modal => {
            modal.classList.add('hidden');
        });
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const ticketModals = document.querySelectorAll('[id^="ticketModal-"]');
        ticketModals.forEach(modal => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });

    // Logout confirmation
    document.addEventListener('DOMContentLoaded', function() {
        const logoutBtn = document.getElementById('logout-button');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Yakin mau logout?')) {
                    const href = this.getAttribute('href');
                    // If CSRF token is available, submit POST to match Laravel's typical logout route
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (csrf) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = href;

                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = '_token';
                        input.value = csrf;
                        form.appendChild(input);

                        document.body.appendChild(form);
                        form.submit();
                    } else {
                        // Fallback to GET if no CSRF token found
                        window.location.href = href;
                    }
                }
            });
        }
    });
</script>

@endsection