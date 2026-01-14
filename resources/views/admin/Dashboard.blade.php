@extends('layout.admin')

@section('content')

    <div class="top-header">
        <div class="header-left">
            <h4>Dashboard</h4>
            <small>Selamat datang kembali, Admin!</small>
        </div>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card gradient">
            <div class="stat-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-value">{{ $totalPemesanan }}</div>
            <div class="stat-label">Total Pemesanan</div>
            <div class="stat-change up">
                <i class="fas fa-arrow-up"></i>
                <span>{{ $totalPemesanan }} pemesanan terdaftar</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-value">{{ $totalPenumpang }}</div>
            <div class="stat-label">Total Penumpang</div>
            <div class="stat-change up">
                <i class="fas fa-arrow-up"></i>
                <span>{{ $totalPenumpang }} penumpang terdaftar</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-plane"></i>
            </div>
            <div class="stat-value">{{ $totalJadwal }}</div>
            <div class="stat-label">Jadwal Penerbangan</div>
            <div class="stat-change">
                <i class="fas fa-info-circle"></i>
                <span>{{ $totalJadwal }} jadwal aktif</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-change up">
                <i class="fas fa-arrow-up"></i>
                <span>Dari pembayaran berhasil</span>
            </div>
        </div>
    </div>
    
    <div class="content-grid">
        <div class="card-section">
            <div class="section-header">
                <div class="section-title">Pemesanan Terbaru</div>
                <a href="{{ route('admin.pemesanan.index') }}" class="view-all">
                    Lihat Semua
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            @forelse($recentPemesanan as $order)
            <div class="project-item">
                <div class="project-icon" style="background: #e3f2fd; color: #2196f3;">
                    <i class="fas fa-plane-departure"></i>
                </div>
                <div class="project-info">
                    <div class="project-name">{{ $order->jadwal->bandaraAsal->nama_bandara ?? 'N/A' }} - {{ $order->jadwal->bandaraTujuan->nama_bandara ?? 'N/A' }}</div>
                    <div class="project-meta">{{ $order->jadwal->pesawat->maskapai->nama_maskapai ?? 'N/A' }} • {{ $order->kode_pemesanan }} • {{ \Carbon\Carbon::parse($order->jadwal->tanggal_berangkat)->format('d M Y') }}</div>
                </div>
                <div class="project-amount">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
            </div>
            @empty
            <div class="project-item">
                <div class="project-info">
                    <div class="project-name">Belum ada pemesanan</div>
                </div>
            </div>
            @endforelse
        </div>
        
        <div class="card-section">
            <div class="section-header">
                <div class="section-title">Statistik Pembayaran</div>
            </div>
            
            <canvas id="paymentChart" style="max-height: 280px;"></canvas>
            
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #f5f6fa;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <div>
                        <div style="font-size: 12px; color: #999; margin-bottom: 5px;">Sukses</div>
                        <div style="font-size: 18px; font-weight: 700; color: #27ae60;">{{ $pembayaranSuccess }}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: #999; margin-bottom: 5px;">Pending</div>
                        <div style="font-size: 18px; font-weight: 700; color: #f39c12;">{{ $pembayaranPending }}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: #999; margin-bottom: 5px;">Gagal</div>
                        <div style="font-size: 18px; font-weight: 700; color: #e74c3c;">{{ $pembayaranFailed }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-section">
        <div class="section-header">
            <div class="section-title">Transaksi Terbaru</div>
            <a href="{{ route('admin.pemesanan.index') }}" class="view-all">
                Lihat Semua
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>KODE PEMESANAN</th>
                    <th>PELANGGAN</th>
                    <th>RUTE</th>
                    <th>TANGGAL</th>
                    <th>JUMLAH</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentPemesanan as $order)
                <tr>
                    <td>{{ $order->kode_pemesanan }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->jadwal->bandaraAsal->kode_bandara ?? 'N/A' }} - {{ $order->jadwal->bandaraTujuan->kode_bandara ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal_pesan)->format('d M Y') }}</td>
                    <td style="font-weight: 600;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="status-badge status-pending">Pending</span>
                        @elseif($order->status == 'paid')
                            <span class="status-badge status-success">Lunas</span>
                        @else
                            <span class="status-badge status-failed">Dibatalkan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999;">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('paymentChart');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Sukses', 'Pending', 'Gagal'],
        datasets: [{
            data: [{{ $pembayaranSuccess }}, {{ $pembayaranPending }}, {{ $pembayaranFailed }}],
            backgroundColor: [
                'rgba(39, 174, 96, 0.8)',
                'rgba(243, 156, 18, 0.8)',
                'rgba(231, 76, 60, 0.8)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    font: {
                        size: 12
                    }
                }
            }
        }
    }
});
</script>
@endpush

@endsection
