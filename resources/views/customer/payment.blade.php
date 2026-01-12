@extends(Auth::check() ? 'layout.Header-cust-auth' : 'layout.Header-cust')

@section('title', 'Pembayaran - CloudTrip Travel Agency')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* Ensure sticky positioning works properly */
    .sticky-sidebar {
        position: sticky;
        top: 6rem;
        height: fit-content;
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

    /* Success Modal Styles */
    .success-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
    }

    .success-modal-content {
        background-color: white;
        margin: 10% auto;
        padding: 40px;
        border-radius: 16px;
        text-align: center;
        max-width: 400px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s ease;
    }

    .success-checkmark {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background-color: #4CAF50;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: scaleIn 0.3s ease;
    }

    .success-checkmark i {
        color: white;
        font-size: 40px;
    }

    .success-title {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .success-message {
        font-size: 16px;
        color: #666;
        margin-bottom: 10px;
    }

    .redirect-timer {
        font-size: 14px;
        color: #999;
        margin-top: 20px;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.5);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Pay Button Hover Effect */
    .pay-button {
        transition: background 0.3s ease !important;
    }

    .pay-button:hover {
        background: linear-gradient(135deg, #ff9f7a 0%, #fa7b76 25%, #d14553 50%, #932d43 75%, #3d1629 100%) !important;
    }

    .pay-button:active {
        background: linear-gradient(135deg, #ff9f7a 0%, #fa7b76 25%, #d14553 50%, #932d43 75%, #3d1629 100%) !important;
    }
</style>
@endpush

@section('content')
@php
    // Data jadwal dari pemesanan
    $flight = $pemesanan->jadwal;
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
        : 'Maskapai Tidak Diketahui';

    $logoPath = $flight->pesawat && $flight->pesawat->maskapai
        ? $flight->pesawat->maskapai->logo
        : null;
@endphp

<div class="bg-gray-50 min-h-screen py-8 mt-6" style="margin-top: 24px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div style="display: flex; gap: 24px;">
            <!-- Left Section - Payment Card (60%) -->
            <div style="flex: 1; max-width: 60%;">
                <!-- Countdown Banner -->
                <div style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.35) 0%, rgba(251, 149, 144, 0.35) 25%, rgba(220, 88, 109, 0.35) 50%, rgba(163, 55, 87, 0.35) 75%, rgba(76, 29, 61, 0.35) 100%); color: rgba(0, 0, 0, 0.8); border-radius: 12px; padding: 12px 16px; margin-bottom: 32px; display: flex; align-items: center; gap: 12px;">
                    <div class="flex-1">
                        <span class="font-medium" style="color: rgba(0, 0, 0, 0.8); font-size: 15px;">Harap selesaikan pembayaran dalam</span>
                        <span id="countdown" style="background: rgba(0,0,0,0.12); padding: 3px 8px; border-radius: 20px; font-weight: 500; font-size: 15px; color: rgba(0,0,0,0.8);">00:52:30</span>
                        <i class="fas fa-stopwatch ml-2" style="opacity: 0.8; font-size: 15px;"></i>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-900">Silakan pilih metode pembayaran!</h2>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-shield-alt text-green-500" style="margin-right: 8px;"></i>
                                Pembayaran Aman
                            </div>
                        </div>
                        <!-- ...existing code... -->
                        <div class="mb-8" style="margin-top: 24px;">
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Virtual Account</h3>
                            </div>
                            <form id="paymentForm" class="space-y-3" onsubmit="processPayment(event)">
                                @csrf
                                <!-- BCA Virtual Account -->
                                <label class="payment-method" style="border: 2px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 12px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: space-between;">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" id="bca" name="payment_method" value="bca" required style="width: 20px; height: 20px; margin-right: 12px;">
                                        <img src="{{ asset('images/bca.png') }}" alt="BCA" style="height: 24px; width: auto;">
                                        <span class="font-semibold text-gray-900">BCA Virtual Account</span>
                                    </div>
                                </label>

                                <!-- Mandiri Virtual Account -->
                                <label class="payment-method" style="border: 2px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 12px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: space-between;">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" id="mandiri" name="payment_method" value="mandiri" required style="width: 20px; height: 20px; margin-right: 12px;">
                                        <img src="{{ asset('images/mandiri.png') }}" alt="Mandiri" style="height: 24px; width: auto;">
                                        <span class="font-semibold text-gray-900">Mandiri Virtual Account</span>
                                    </div>
                                </label>

                                <!-- BRI Virtual Account -->
                                <label class="payment-method" style="border: 2px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 12px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: space-between;">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" id="bri" name="payment_method" value="bri" required style="width: 20px; height: 20px; margin-right: 12px;">
                                        <img src="{{ asset('images/bri.png') }}" alt="BRI" style="height: 24px; width: auto;">
                                        <span class="font-semibold text-gray-900">BRI Virtual Account</span>
                                    </div>
                                </label>

                                <!-- BNI Virtual Account -->
                                <label class="payment-method" style="border: 2px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 12px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: space-between;">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" id="bni" name="payment_method" value="bni" required style="width: 20px; height: 20px; margin-right: 12px;">
                                        <img src="{{ asset('images/bni.png') }}" alt="BNI" style="height: 24px; width: auto;">
                                        <span class="font-semibold text-gray-900">BNI Virtual Account</span>
                                    </div>
                                </label>

                                <!-- Pay Button -->
                                <button type="submit" id="payButton" class="pay-button" style="width: 100%; padding: 14px 24px; margin-top: 24px; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; transition: background 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.08); letter-spacing: 0.5px; background: linear-gradient(135deg, #ffb894 0%, #fb9590 25%, #dc586d 50%, #a33757 75%, #4c1d3d 100%); cursor: pointer;">
                                    Bayar Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section - Flight Summary & Price (40%) -->
            <div style="flex: 1; max-width: 40%; align-self: flex-start;">
                <div class="sticky-sidebar" style="display: flex; flex-direction: column; gap: 24px;">
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
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6" style="background-color: white !important;">
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
<!-- Success Modal -->
<div id="successModal" class="success-modal">
    <div class="success-modal-content">
        <div class="success-checkmark">
            <i class="fas fa-check"></i>
        </div>
        <div class="success-title">Pembayaran Berhasil!</div>
        <div class="success-message">Terima kasih telah menyelesaikan pembayaran. Data pembayaran Anda telah tersimpan.</div>
        <div style="margin-top: 30px; display: flex; gap: 12px;">
            <button onclick="goBack()" style="flex: 1; padding: 12px 24px; background: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; transition: all 0.3s ease;">
                Kembali
            </button>
            <button onclick="goHome()" style="flex: 1; padding: 12px 24px; background: linear-gradient(135deg, #ffb894 0%, #fb9590 25%, #dc586d 50%, #a33757 75%, #4c1d3d 100%); color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; transition: all 0.3s ease;">
                Ke Beranda
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown timer
    let timeLeft = 52 * 60 + 30; // 52 minutes 30 seconds
    const countdownEl = document.getElementById('countdown');

    function updateCountdown() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        countdownEl.textContent = `${String(Math.floor(minutes / 60)).padStart(2, '0')}:${String(minutes % 60).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        if (timeLeft > 0) {
            timeLeft--;
        } else {
            clearInterval(countdownInterval);
            // Handle timeout
        }
    }

    const countdownInterval = setInterval(updateCountdown, 1000);
    updateCountdown();

    // Handle sticky sidebar
    const stickySidebar = document.querySelector('.sticky-sidebar');

    if (stickySidebar) {
        const originalPosition = stickySidebar.getBoundingClientRect();
        const originalWidth = stickySidebar.offsetWidth;
        const originalLeft = originalPosition.left;

        window.addEventListener('scroll', function() {
            const scrollTop = window.scrollY;
            const sidebarRect = stickySidebar.getBoundingClientRect();

            if (sidebarRect.top <= 96) {
                // Sticky mode
                stickySidebar.style.position = 'fixed';
                stickySidebar.style.top = '96px';
                stickySidebar.style.left = originalLeft + 'px';
                stickySidebar.style.width = originalWidth + 'px';
                stickySidebar.style.zIndex = '20';
            } else {    
                // Normal mode
                stickySidebar.style.position = 'relative';
                stickySidebar.style.left = 'auto';
                stickySidebar.style.top = 'auto';
                stickySidebar.style.width = 'auto';
                stickySidebar.style.zIndex = 'auto';
            }
        });
    }
});

function processPayment() {
    console.log('processPayment function called');

    // Dapatkan metode pembayaran yang dipilih
    const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
    console.log('Selected method:', selectedMethod);

    if (!selectedMethod) {
        console.log('No payment method selected - showing alert');
        alert('Pilih metode pembayaran terlebih dahulu!');
        return;
    }

    console.log('Payment method selected:', selectedMethod.value);

    // Kirim data pembayaran ke server
    const paymentData = {
        pemesanan_id: {!! $pemesanan->id !!},
        metode: selectedMethod.value,
        jumlah: {!! $flight->harga !!},
        status: 'success'
    };

    console.log('Payment data:', paymentData);

    // AJAX request untuk menyimpan pembayaran
    fetch('{{ route("payment.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]') ? document.querySelector('input[name="_token"]').value : ''
        },
        body: JSON.stringify(paymentData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            // Tampilkan modal sukses
            const modal = document.getElementById('successModal');
            modal.style.display = 'block';
        } else {
            alert('Terjadi kesalahan: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses pembayaran');
    });
}

function goBack() {
    // Tutup modal dan kembali ke halaman pembayaran
    const modal = document.getElementById('successModal');
    modal.style.display = 'none';
    location.reload();
}

function goHome() {
    // Arahkan ke halaman beranda
    window.location.href = '{{ route("homepage") }}';
}
</script>
@endpush
