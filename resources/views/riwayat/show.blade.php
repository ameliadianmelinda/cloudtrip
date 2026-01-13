@extends('layout.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Detail Riwayat Pemesanan</h2>

    <div class="row">
        <!-- Info Pemesanan -->
        <div class="col-md-6">
            <div class="card p-3 mb-3">
                <h5 class="fw-bold mb-3">Info Pemesanan</h5>
                <div class="mb-2"><strong>Kode:</strong> {{ $p->kode_pemesanan }}</div>
                <div class="mb-2"><strong>Pemesan:</strong> {{ $p->user->name ?? $p->user_id }}</div>
                <div class="mb-2"><strong>Email:</strong> {{ $p->user->email ?? '-' }}</div>
                <div class="mb-2"><strong>Tanggal Pesan:</strong> {{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d/m/Y H:i') }}</div>
                <div class="mb-2"><strong>Total Harga:</strong> <span class="text-danger fw-bold">{{ number_format($p->total_harga, 0, ',', '.') }}</span></div>
                <div class="mb-2"><strong>Status Pemesanan:</strong> <span class="badge bg-info">{{ $p->status }}</span></div>
            </div>
        </div>

        <!-- Info Jadwal -->
        <div class="col-md-6">
            <div class="card p-3 mb-3">
                <h5 class="fw-bold mb-3">Info Penerbangan</h5>
                @if($p->jadwal)
                    <div class="mb-2"><strong>Maskapai:</strong> {{ $p->jadwal->pesawat->maskapai->nama_maskapai ?? 'Maskapai #'.$p->jadwal->pesawat->maskapai_id }}</div>
                    <div class="mb-2"><strong>Pesawat:</strong> {{ $p->jadwal->pesawat->kode_pesawat ?? 'Pesawat #'.$p->jadwal->pesawat_id }}</div>
                    <div class="mb-2"><strong>Tipe:</strong> {{ $p->jadwal->pesawat->tipe_pesawat ?? '-' }}</div>
                    <div class="mb-2"><strong>Rute:</strong> {{ $p->jadwal->bandaraAsal->kode_bandara ?? 'Bandara #'.$p->jadwal->bandara_asal }} → {{ $p->jadwal->bandaraTujuan->kode_bandara ?? 'Bandara #'.$p->jadwal->bandara_tujuan }}</div>
                    <div class="mb-2"><strong>Tanggal Berangkat:</strong> {{ $p->jadwal->tanggal_berangkat }} {{ $p->jadwal->waktu_berangkat }}</div>
                    <div class="mb-2"><strong>Waktu Tiba:</strong> {{ $p->jadwal->waktu_tiba }}</div>
                @else
                    <p class="text-muted">Jadwal tidak ditemukan</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Detail Penumpang -->
    <div class="card p-3 mb-3">
        <h5 class="fw-bold mb-3">Detail Penumpang</h5>
        @if($p->detailPemesanan->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Penumpang</th>
                            <th>NIK</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($p->detailPemesanan as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->penumpang->nama_penumpang ?? 'Penumpang #'.$detail->penumpang_id }}</td>
                                <td>{{ $detail->penumpang->nik ?? '-' }}</td>
                                <td>{{ $detail->penumpang->umur ?? '-' }}</td>
                                <td>{{ $detail->penumpang->jenis_kelamin == 'L' ? 'Laki-laki' : ($detail->penumpang->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Belum ada detail penumpang</p>
        @endif
    </div>

    <!-- Status Pembayaran -->
    <div class="card p-3 mb-3">
        <h5 class="fw-bold mb-3">Status Pembayaran</h5>
        @if($p->pembayaran->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Metode</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($p->pembayaran as $bayar)
                            <tr>
                                <td>{{ ucfirst($bayar->metode) }}</td>
                                <td>{{ number_format($bayar->jumlah, 0, ',', '.') }}</td>
                                <td>
                                    @if($bayar->status == 'success')
                                        <span class="badge bg-success">{{ $bayar->status }}</span>
                                    @elseif($bayar->status == 'pending')
                                        <span class="badge bg-warning">{{ $bayar->status }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $bayar->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $bayar->tanggal_bayar ? \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d/m/Y H:i') : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Belum ada riwayat pembayaran</p>
        @endif
    </div>

    <div class="mt-3">
        <a href="{{ route('riwayat.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>
@endsection
