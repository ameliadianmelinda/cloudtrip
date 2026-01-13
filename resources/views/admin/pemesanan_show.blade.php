<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan #{{ $pemesanan->kode_pemesanan }} - CloudTrip Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin-pemesanan-detail.css') }}" rel="stylesheet">
</head>
<body>
<div class="main-content">
    <div class="top-header">
        <div class="header-left">
            <a href="{{ route('admin.pemesanan.index') }}" class="btn-back-header">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="header-title">
                <h4>Detail Pemesanan</h4>
                <small>{{ $pemesanan->kode_pemesanan }}</small>
            </div>
        </div>
        <div class="header-actions">
            <span class="status-badge status-{{ $pemesanan->status }}">
                @if($pemesanan->status == 'pending')
                    <i class="fas fa-clock"></i> Menunggu Pembayaran
                @elseif($pemesanan->status == 'paid')
                    <i class="fas fa-check-circle"></i> Lunas
                @else
                    <i class="fas fa-times-circle"></i> Dibatalkan
                @endif
            </span>
        </div>
    </div>

    @if(session('success'))
    <div class="alert-custom">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="content-grid">
        <!-- Informasi Penerbangan -->
        <div class="info-card">
            <div class="card-header">
                <div class="card-icon flight-icon">
                    <i class="fas fa-plane-departure"></i>
                </div>
                <div>
                    <h5>Informasi Penerbangan</h5>
                    <small>Detail jadwal penerbangan</small>
                </div>
            </div>
            
            <div class="flight-route">
                <div class="route-item">
                    <div class="route-label">Bandara Keberangkatan</div>
                    <div class="route-value">
                        <strong>{{ $pemesanan->jadwal->bandaraAsal->nama_bandara ?? 'N/A' }}</strong>
                    </div>
                    <div class="route-meta">
                        <i class="fas fa-map-marker-alt"></i> 
                        {{ $pemesanan->jadwal->bandaraAsal->kota ?? '' }} 
                        ({{ $pemesanan->jadwal->bandaraAsal->kode_bandara ?? '' }})
                    </div>
                </div>

                <div class="route-arrow">
                    <i class="fas fa-long-arrow-alt-right"></i>
                </div>

                <div class="route-item">
                    <div class="route-label">Bandara Tujuan</div>
                    <div class="route-value">
                        <strong>{{ $pemesanan->jadwal->bandaraTujuan->nama_bandara ?? 'N/A' }}</strong>
                    </div>
                    <div class="route-meta">
                        <i class="fas fa-map-marker-alt"></i> 
                        {{ $pemesanan->jadwal->bandaraTujuan->kota ?? '' }} 
                        ({{ $pemesanan->jadwal->bandaraTujuan->kode_bandara ?? '' }})
                    </div>
                </div>
            </div>

            <div class="flight-details">
                <div class="detail-row">
                    <div class="detail-item">
                        <i class="fas fa-calendar-day"></i>
                        <div>
                            <small>Tanggal Keberangkatan</small>
                            <strong>
                                {{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_berangkat)->isoFormat('dddd, D MMMM YYYY') }}
                            </strong>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <small>Waktu Keberangkatan</small>
                            <strong>{{ $pemesanan->jadwal->waktu_berangkat }}</strong>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <small>Waktu Tiba</small>
                            <strong>{{ $pemesanan->jadwal->waktu_tiba }}</strong>
                        </div>
                    </div>
                </div>

                <div class="maskapai-info">
                    <div class="maskapai-logo">
                        <i class="fas fa-plane"></i>
                    </div>
                    <div>
                        <small>Maskapai</small>
                        <strong>{{ $pemesanan->jadwal->pesawat->maskapai->nama_maskapai ?? 'N/A' }}</strong>
                        <span class="flight-number">
                            {{ $pemesanan->jadwal->pesawat->maskapai->kode_maskapai ?? '' }}-{{ $pemesanan->jadwal->pesawat->nomor_pesawat ?? '' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Customer -->
        <div class="info-card">
            <div class="card-header">
                <div class="card-icon customer-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h5>Informasi Customer</h5>
                    <small>Data pemesan tiket</small>
                </div>
            </div>
            
            <div class="customer-details">
                <div class="customer-avatar">
                    {{ strtoupper(substr($pemesanan->user->name ?? 'U', 0, 1)) }}
                </div>
                <div class="customer-info">
                    <h6>{{ $pemesanan->user->name ?? 'N/A' }}</h6>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $pemesanan->user->email ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-hashtag"></i>
                        <span>User ID: {{ $pemesanan->user->id ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Penumpang -->
        <div class="info-card passengers-card">
            <div class="card-header">
                <div class="card-icon passenger-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <h5>Daftar Penumpang</h5>
                    <small>{{ $pemesanan->detailPemesanan->count() }} Penumpang</small>
                </div>
            </div>
            
            <div class="passengers-list">
                @foreach($pemesanan->detailPemesanan as $index => $detail)
                <div class="passenger-item">
                    <div class="passenger-number">{{ $index + 1 }}</div>
                    <div class="passenger-info">
                        <strong>{{ $detail->penumpang->nama_penumpang ?? 'N/A' }}</strong>
                        <div class="passenger-meta">
                            <span><i class="fas fa-id-card"></i> NIK: {{ $detail->penumpang->nik ?? 'N/A' }}</span>
                            <span><i class="fas fa-birthday-cake"></i> {{ $detail->penumpang->umur ?? 0 }} Tahun</span>
                            <span>
                                <i class="fas fa-venus-mars"></i> 
                                {{ $detail->penumpang->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Informasi Pembayaran -->
        <div class="info-card">
            <div class="card-header">
                <div class="card-icon payment-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div>
                    <h5>Informasi Pembayaran</h5>
                    <small>Detail pembayaran</small>
                </div>
            </div>
            
            @if($pemesanan->pembayaran)
            <div class="payment-details">
                <div class="payment-row">
                    <span>Metode Pembayaran</span>
                    <strong class="payment-method">
                        @if($pemesanan->pembayaran->metode == 'transfer')
                            <i class="fas fa-university"></i> Transfer Bank
                        @elseif($pemesanan->pembayaran->metode == 'qris')
                            <i class="fas fa-qrcode"></i> QRIS
                        @else
                            <i class="fas fa-wallet"></i> Virtual Account
                        @endif
                    </strong>
                </div>
                <div class="payment-row">
                    <span>Status Pembayaran</span>
                    <span class="payment-status payment-{{ $pemesanan->pembayaran->status }}">
                        @if($pemesanan->pembayaran->status == 'success')
                            <i class="fas fa-check-circle"></i> Berhasil
                        @elseif($pemesanan->pembayaran->status == 'pending')
                            <i class="fas fa-clock"></i> Pending
                        @else
                            <i class="fas fa-times-circle"></i> Gagal
                        @endif
                    </span>
                </div>
                <div class="payment-row">
                    <span>Tanggal Pembayaran</span>
                    <strong>
                        {{ \Carbon\Carbon::parse($pemesanan->pembayaran->tanggal_bayar)->isoFormat('D MMMM YYYY, HH:mm') }}
                    </strong>
                </div>
                <div class="payment-row total">
                    <span>Jumlah Dibayar</span>
                    <strong class="amount">Rp {{ number_format($pemesanan->pembayaran->jumlah, 0, ',', '.') }}</strong>
                </div>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-receipt"></i>
                <p>Belum ada pembayaran</p>
            </div>
            @endif
        </div>

        <!-- Ringkasan Pemesanan -->
        <div class="info-card summary-card">
            <div class="card-header">
                <div class="card-icon summary-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div>
                    <h5>Ringkasan Pemesanan</h5>
                    <small>Total biaya</small>
                </div>
            </div>
            
            <div class="summary-details">
                <div class="summary-row">
                    <span>Kode Pemesanan</span>
                    <strong>{{ $pemesanan->kode_pemesanan }}</strong>
                </div>
                <div class="summary-row">
                    <span>Tanggal Pesan</span>
                    <strong>
                        {{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('D MMMM YYYY, HH:mm') }}
                    </strong>
                </div>
                <div class="summary-row">
                    <span>Jumlah Penumpang</span>
                    <strong>{{ $pemesanan->detailPemesanan->count() }} Orang</strong>
                </div>
                <div class="summary-row">
                    <span>Harga per Tiket</span>
                    <strong>Rp {{ number_format($pemesanan->jadwal->harga, 0, ',', '.') }}</strong>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-row total-row">
                    <span>Total Harga</span>
                    <strong class="total-amount">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</strong>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-section">
                <form action="{{ route('admin.pemesanan.updateStatus', $pemesanan->pemesanan_id) }}" method="POST" id="statusForm">
                    @csrf
                    @method('PUT')
                    <label>Update Status Pemesanan</label>
                    <div class="status-actions">
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $pemesanan->status == 'paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="cancel" {{ $pemesanan->status == 'cancel' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <button type="submit" class="btn-update">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('statusForm').addEventListener('submit', function(e) {
    if (!confirm('Yakin ingin mengubah status pemesanan?')) {
        e.preventDefault();
    }
});
</script>
</body>
</html>
