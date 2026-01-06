@extends('layout.admin')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pemesanan - CloudTrip Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin-pemesanan-index.css') }}" rel="stylesheet">
</head>
<body>
<div class="main-content">
    <div class="top-header">
        <div class="header-title">
            <h4>Manajemen Pemesanan</h4>
            <small>Kelola semua pemesanan tiket pesawat</small>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" placeholder="Cari kode pemesanan..." id="searchInput">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert-custom">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="stats-cards">
        <div class="stat-card gradient">
            <div class="stat-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-value">{{ $pemesanan->total() }}</div>
            <div class="stat-label">Total Pemesanan</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon pending-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-value">{{ $pemesanan->where('status', 'pending')->count() }}</div>
            <div class="stat-label">Pending</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-value">{{ $pemesanan->where('status', 'paid')->count() }}</div>
            <div class="stat-label">Lunas</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon cancel-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-value">{{ $pemesanan->where('status', 'cancel')->count() }}</div>
            <div class="stat-label">Dibatalkan</div>
        </div>
    </div>

    <div class="filter-section">
        <div class="section-title">Daftar Pemesanan</div>
        <div class="filter-tabs">
            <button class="filter-tab active" onclick="filterOrders('all')">Semua</button>
            <button class="filter-tab" onclick="filterOrders('pending')">Pending</button>
            <button class="filter-tab" onclick="filterOrders('paid')">Lunas</button>
            <button class="filter-tab" onclick="filterOrders('cancel')">Dibatalkan</button>
        </div>
    </div>

    <div class="orders-table">
        @forelse($pemesanan as $order)
        <div class="order-card" data-status="{{ $order->status }}">
            <div class="order-header">
                <div class="order-code">
                    <i class="fas fa-ticket-alt"></i>
                    <strong>{{ $order->kode_pemesanan }}</strong>
                </div>
                <span class="status-badge status-{{ $order->status }}">
                    @if($order->status == 'pending')
                        <i class="fas fa-clock"></i> Pending
                    @elseif($order->status == 'paid')
                        <i class="fas fa-check-circle"></i> Lunas
                    @else
                        <i class="fas fa-times-circle"></i> Dibatalkan
                    @endif
                </span>
            </div>

            <div class="order-body">
                <div class="order-flight">
                    <div class="flight-route">
                        <div class="route-point">
                            <i class="fas fa-plane-departure"></i>
                            <div>
                                <strong>{{ $order->jadwal->bandaraAsal->kode_bandara ?? 'N/A' }}</strong>
                                <small>{{ $order->jadwal->bandaraAsal->kota ?? '' }}</small>
                            </div>
                        </div>
                        <div class="route-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="route-point">
                            <i class="fas fa-plane-arrival"></i>
                            <div>
                                <strong>{{ $order->jadwal->bandaraTujuan->kode_bandara ?? 'N/A' }}</strong>
                                <small>{{ $order->jadwal->bandaraTujuan->kota ?? '' }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-info">
                    <div class="info-row">
                        <div class="info-item">
                            <i class="fas fa-user"></i>
                            <div>
                                <small>Customer</small>
                                <strong>{{ $order->user->name ?? 'N/A' }}</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calendar"></i>
                            <div>
                                <small>Tanggal Pesan</small>
                                <strong>{{ \Carbon\Carbon::parse($order->tanggal_pesan)->format('d M Y') }}</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-users"></i>
                            <div>
                                <small>Penumpang</small>
                                <strong>{{ $order->detailPemesanan->count() }} Orang</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-money-bill-wave"></i>
                            <div>
                                <small>Total</small>
                                <strong class="text-price">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                @if($order->pembayaran)
                <div class="payment-info">
                    <span class="payment-badge">
                        @if($order->pembayaran->metode == 'transfer')
                            <i class="fas fa-university"></i> Transfer Bank
                        @elseif($order->pembayaran->metode == 'qris')
                            <i class="fas fa-qrcode"></i> QRIS
                        @else
                            <i class="fas fa-wallet"></i> Virtual Account
                        @endif
                    </span>
                    <span class="payment-status payment-{{ $order->pembayaran->status }}">
                        @if($order->pembayaran->status == 'success')
                            <i class="fas fa-check"></i> Berhasil
                        @elseif($order->pembayaran->status == 'pending')
                            <i class="fas fa-clock"></i> Pending
                        @else
                            <i class="fas fa-times"></i> Gagal
                        @endif
                    </span>
                </div>
                @endif
            </div>

            <div class="order-footer">
                <a href="{{ route('admin.pemesanan.show', $order->pemesanan_id) }}" class="btn-detail">
                    <i class="fas fa-eye"></i>
                    Lihat Detail
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <p>Belum ada pemesanan</p>
        </div>
        @endforelse
    </div>
    
    @if($pemesanan->hasPages())
    <div class="pagination-wrapper">
        {{ $pemesanan->links() }}
    </div>
    @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('searchInput').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.order-card');
    
    cards.forEach(card => {
        const code = card.querySelector('.order-code strong').textContent.toLowerCase();
        const customer = card.querySelector('.info-item strong').textContent.toLowerCase();
        
        if (code.includes(searchTerm) || customer.includes(searchTerm)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});

function filterOrders(status) {
    const cards = document.querySelectorAll('.order-card');
    const tabs = document.querySelectorAll('.filter-tab');
    
    tabs.forEach(tab => tab.classList.remove('active'));
    event.target.classList.add('active');
    
    cards.forEach(card => {
        if (status === 'all' || card.dataset.status === status) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
</body>
</html>

@endsection