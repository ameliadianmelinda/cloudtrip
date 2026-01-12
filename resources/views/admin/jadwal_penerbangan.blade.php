@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Jadwal Penerbangan</h2>
    <a href="{{ route('jadwal_penerbangan.create') }}" class="btn btn-danger">+ Tambah Jadwal Penerbangan</a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive bg-white rounded shadow p-3">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th style="width: 50px;">No</th>
                <th>Pesawat</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Tanggal</th>
                <th>Berangkat</th>
                <th>Tiba</th>
                <th>Harga</th>
                <th>Status</th>
                <th style="width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwal as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-nowrap">{{ $item->pesawat->kode_pesawat ?? '-' }} - {{ $item->pesawat->tipe_pesawat ?? '-' }}</td>
                    <td>{{ $item->bandaraAsal->nama_bandara ?? '-' }}</td>
                    <td>{{ $item->bandaraTujuan->nama_bandara ?? '-' }}</td>
                    <td class="text-nowrap">{{ $item->tanggal_berangkat ? $item->tanggal_berangkat->format('d/m/Y') : '-' }}</td>
                    <td class="text-nowrap">{{ $item->waktu_berangkat ? $item->waktu_berangkat->format('H:i') : '-' }}</td>
                    <td class="text-nowrap">{{ $item->waktu_tiba ? $item->waktu_tiba->format('H:i') : '-' }}</td>
                    <td class="text-nowrap">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge 
                            @if($item->status == 'available') bg-success
                            @elseif($item->status == 'cancel') bg-danger
                            @else bg-warning
                            @endif">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('jadwal_penerbangan.edit', $item->jadwal_id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('jadwal_penerbangan.destroy', $item->jadwal_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data jadwal penerbangan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection