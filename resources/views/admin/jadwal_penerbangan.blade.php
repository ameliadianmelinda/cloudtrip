@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Jadwal Penerbangan</h2>
    <a href="{{ route('jadwal_penerbangan.create') }}" class="btn btn-danger">+ Tambah Jadwal</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive bg-white rounded shadow p-3">
    <table class="table table-hover table-striped align-middle mb-0 jadwal-table">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Maskapai</th>
                <th>Kode Pesawat</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Tanggal</th>
                <th>Berangkat</th>
                <th>Tiba</th>
                <th class="text-end">Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pesawat->maskapai->nama_maskapai ?? '-' }}</td>
                    <td>{{ $item->pesawat->kode_pesawat ?? '-' }}</td>
                    <td>{{ $item->bandaraAsal->nama_bandara ?? '-' }}</td>
                    <td>{{ $item->bandaraTujuan->nama_bandara ?? '-' }}</td>
                    <td>{{ $item->tanggal_berangkat ? \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $item->waktu_berangkat ? \Carbon\Carbon::parse($item->waktu_berangkat)->format('H:i') : '-' }}</td>
                    <td>{{ $item->waktu_tiba ? \Carbon\Carbon::parse($item->waktu_tiba)->format('H:i') : '-' }}</td>
                    <td class="text-end">{{ $item->harga ? number_format($item->harga, 0, ',', '.') : '-' }}</td>
                    <td>
                        @if($item->status == 'available')
                            <span class="badge bg-success">Available</span>
                        @elseif($item->status == 'delay')
                            <span class="badge bg-warning text-dark">Delay</span>
                        @else
                            <span class="badge bg-danger">Cancel</span>
                        @endif
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
