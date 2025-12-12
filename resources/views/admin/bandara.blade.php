@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Bandara</h2>
    <a href="{{ route('bandara.create') }}" class="btn btn-danger">+ Tambah Bandara</a>
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
                <th>Kode</th>
                <th>Nama Bandara</th>
                <th>Kota</th>
                <th>Negara</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bandara as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_bandara }}</td>
                <td>{{ $item->nama_bandara }}</td>
                <td>{{ $item->kota }}</td>
                <td>{{ $item->negara }}</td>
                <td>
                    <a href="{{ route('bandara.edit', $item->bandara_id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('bandara.destroy', $item->bandara_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>
@endsection
