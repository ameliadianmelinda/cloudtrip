@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Laporan Jadwal Penerbangan</h2>
    <a href="{{ route('jadwal_penerbangan.create') }}" class="btn btn-danger">+ Tambah Jadwal</a>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card-section">
            <h6 class="text-muted">Total Jadwal</h6>
            <h3 class="fw-bold">{{ $summary['total'] }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-section">
            <h6 class="text-muted">Available</h6>
            <h3 class="fw-bold text-success">{{ $summary['available'] }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-section">
            <h6 class="text-muted">Delay</h6>
            <h3 class="fw-bold text-warning">{{ $summary['delay'] }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-section">
            <h6 class="text-muted">Cancel</h6>
            <h3 class="fw-bold text-danger">{{ $summary['cancel'] }}</h3>
        </div>
    </div>
</div>

<div class="card-section">
    <div class="table-responsive">
        <table class="table table-striped align-middle jadwal-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Maskapai</th>
                    <th>Kode</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Berangkat</th>
                    <th>Tiba</th>
                    <th class="text-end">Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $j)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $j->pesawat->maskapai->nama_maskapai ?? '-' }}</td>
                    <td>{{ $j->pesawat->kode_pesawat ?? '-' }}</td>
                    <td>{{ $j->bandaraAsal->nama_bandara ?? '-' }}</td>
                    <td>{{ $j->bandaraTujuan->nama_bandara ?? '-' }}</td>
                    <td>{{ $j->tanggal_berangkat ? \Carbon\Carbon::parse($j->tanggal_berangkat)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $j->waktu_berangkat ? \Carbon\Carbon::parse($j->waktu_berangkat)->format('H:i') : '-' }}</td>
                    <td>{{ $j->waktu_tiba ? \Carbon\Carbon::parse($j->waktu_tiba)->format('H:i') : '-' }}</td>
                    <td class="text-end">{{ $j->harga ? number_format($j->harga,0,',','.') : '-' }}</td>
                    <td>
                        @if($j->status == 'available')
                            <span class="badge bg-success">Available</span>
                        @elseif($j->status == 'delay')
                            <span class="badge bg-warning text-dark">Delay</span>
                        @else
                            <span class="badge bg-danger">Cancel</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4 d-flex justify-content-between align-items-center">
    <h4 class="fw-bold">Ringkasan Transaksi</h4>
    <div>
        <a href="{{ route('laporan.print') }}" target="_blank" class="btn btn-outline-secondary">Print / PDF</a>
    </div>
</div>

<div class="card-section mt-3">
    <div class="mb-3">
        <strong>Total Transaksi:</strong> {{ $transSummary['total_transactions'] }}
        &nbsp;&nbsp; <strong>Total Pendapatan:</strong> {{ number_format($transSummary['total_revenue'],0,',','.') }}
    </div>
    <div class="table-responsive">
        <table class="table table-striped align-middle jadwal-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Customer</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Tanggal Pesan</th>
                    <th class="text-end">Nominal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanan as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->kode_pemesanan }}</td>
                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td>{{ $p->jadwal->bandaraAsal->nama_bandara ?? '-' }}</td>
                    <td>{{ $p->jadwal->bandaraTujuan->nama_bandara ?? '-' }}</td>
                    <td>{{ $p->tanggal_pesan }}</td>
                    <td class="text-end">{{ $p->total_harga ? number_format($p->total_harga,0,',','.') : '-' }}</td>
                    <td>{{ ucfirst($p->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
