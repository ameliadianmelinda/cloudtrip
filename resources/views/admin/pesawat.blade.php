@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Pesawat</h2>
    <a href="{{ route('pesawat.create') }}" class="btn btn-danger">+ Tambah Pesawat</a>
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
                <th>No</th>
                <th>Kode Pesawat</th>
                <th>Tipe Pesawat</th>
                <th>Maskapai</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesawat as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_pesawat }}</td>
                    <td>{{ $item->tipe_pesawat }}</td>
                    <td>{{ $item->maskapai->nama_maskapai ?? '-' }}</td>
                    <td>{{ $item->kapasitas }}</td>
                    <td>
                        <a href="{{ route('pesawat.edit', $item->pesawat_id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pesawat.destroy', $item->pesawat_id) }}" method="POST" style="display:inline;">
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
