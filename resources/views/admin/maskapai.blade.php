@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Maskapai</h2>
    <a href="{{ route('maskapai.create') }}" class="btn btn-danger">+ Tambah Maskapai</a>
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
                <th>Kode Maskapai</th>
                <th>Nama Maskapai</th>
                <th>Logo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maskapai as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_maskapai }}</td>
                    <td>{{ $item->nama_maskapai }}</td>
                    <td>
                        @if($item->logo)
                            <img src="{{ asset($item->logo) }}" alt="logo" width="60" height="60" style="object-fit: cover; border-radius: 4px;">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('maskapai.edit', $item->maskapai_id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('maskapai.destroy', $item->maskapai_id) }}" method="POST" style="display:inline;">
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
