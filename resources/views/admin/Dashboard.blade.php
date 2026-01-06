@extends('layout.admin')

@section('content')

    <div class="top-header">
        <div class="header-left">
            <h4>Dashboard</h4>
            <small>Selamat datang kembali, Admin!</small>
        </div>
        <div class="header-right">
            <div class="header-icon">
                <i class="fas fa-search"></i>
            </div>
            <div class="header-icon">
                <i class="fas fa-bell"></i>
                <span class="badge-notification">5</span>
            </div>
            <div class="user-profile">
                <div class="user-avatar">A</div>
            </div>
        </div>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card gradient">
            <div class="stat-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-value">1,254</div>
            <div class="stat-label">Total Pemesanan</div>
            <div class="stat-change up">
                <i class="fas fa-arrow-up"></i>
                <span>+12.5% dari bulan lalu</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-value">842</div>
            <div class="stat-label">Total Penumpang</div>
            <div class="stat-change up">
                <i class="fas fa-arrow-up"></i>
                <span>+8.3%</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-plane"></i>
            </div>
            <div class="stat-value">156</div>
            <div class="stat-label">Jadwal Penerbangan</div>
            <div class="stat-change down">
                <i class="fas fa-arrow-down"></i>
                <span>-2.1%</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-value">Rp 45.2M</div>
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-change up">
                <i class="fas fa-arrow-up"></i>
                <span>+15.8%</span>
            </div>
        </div>
    </div>
    
    <div class="content-grid">
        <div class="card-section">
            <div class="section-header">
                <div class="section-title">Pemesanan Terbaru</div>
                <a href="#" class="view-all">
                    Lihat Semua
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="project-item">
                <div class="project-icon" style="background: #e3f2fd; color: #2196f3;">
                    <i class="fas fa-plane-departure"></i>
                </div>
                <div class="project-info">
                    <div class="project-name">Jakarta - Bali</div>
                    <div class="project-meta">Garuda Indonesia • GA-404 • 15 Des 2025</div>
                </div>
                <div class="project-amount">Rp 1.2jt</div>
            </div>
            
            <div class="project-item">
                <div class="project-icon" style="background: #f3e5f5; color: #9c27b0;">
                    <i class="fas fa-plane-arrival"></i>
                </div>
                <div class="project-info">
                    <div class="project-name">Surabaya - Jakarta</div>
                    <div class="project-meta">Lion Air • JT-720 • 14 Des 2025</div>
                </div>
                <div class="project-amount">Rp 850rb</div>
            </div>
            
            <div class="project-item">
                <div class="project-icon" style="background: #fff3e0; color: #ff9800;">
                    <i class="fas fa-plane"></i>
                </div>
                <div class="project-info">
                    <div class="project-name">Medan - Batam</div>
                    <div class="project-meta">Citilink • QG-815 • 14 Des 2025</div>
                </div>
                <div class="project-amount">Rp 675rb</div>
            </div>
            
            <div class="project-item">
                <div class="project-icon" style="background: #e8f5e9; color: #4caf50;">
                    <i class="fas fa-plane-departure"></i>
                </div>
                <div class="project-info">
                    <div class="project-name">Yogyakarta - Jakarta</div>
                    <div class="project-meta">AirAsia • QZ-7510 • 13 Des 2025</div>
                </div>
                <div class="project-amount">Rp 425rb</div>
            </div>
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
                        <div style="font-size: 18px; font-weight: 700; color: #27ae60;">1,048</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: #999; margin-bottom: 5px;">Pending</div>
                        <div style="font-size: 18px; font-weight: 700; color: #f39c12;">142</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: #999; margin-bottom: 5px;">Gagal</div>
                        <div style="font-size: 18px; font-weight: 700; color: #e74c3c;">64</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-section">
        <div class="section-header">
            <div class="section-title">Transaksi Terbaru</div>
            <a href="#" class="view-all">
                Lihat Semua
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>ID TRANSAKSI</th>
                    <th>PELANGGAN</th>
                    <th>RUTE</th>
                    <th>TANGGAL</th>
                    <th>JUMLAH</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#TRX-1254</td>
                    <td>Budi Santoso</td>
                    <td>CGK - DPS</td>
                    <td>15 Des 2025</td>
                    <td style="font-weight: 600;">Rp 1.2jt</td>
                    <td><span class="status-badge status-success">Sukses</span></td>
                </tr>
                <tr>
                    <td>#TRX-1253</td>
                    <td>Siti Nurhaliza</td>
                    <td>SUB - CGK</td>
                    <td>14 Des 2025</td>
                    <td style="font-weight: 600;">Rp 850rb</td>
                    <td><span class="status-badge status-pending">Pending</span></td>
                </tr>
                <tr>
                    <td>#TRX-1252</td>
                    <td>Ahmad Dahlan</td>
                    <td>KNO - BTH</td>
                    <td>14 Des 2025</td>
                    <td style="font-weight: 600;">Rp 675rb</td>
                    <td><span class="status-badge status-success">Sukses</span></td>
                </tr>
                <tr>
                    <td>#TRX-1251</td>
                    <td>Dewi Lestari</td>
                    <td>JOG - CGK</td>
                    <td>13 Des 2025</td>
                    <td style="font-weight: 600;">Rp 425rb</td>
                    <td><span class="status-badge status-failed">Gagal</span></td>
                </tr>
                <tr>
                    <td>#TRX-1250</td>
                    <td>Joko Widodo</td>
                    <td>CGK - UPG</td>
                    <td>13 Des 2025</td>
                    <td style="font-weight: 600;">Rp 950rb</td>
                    <td><span class="status-badge status-success">Sukses</span></td>
                </tr>
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
            data: [1048, 142, 64],
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
