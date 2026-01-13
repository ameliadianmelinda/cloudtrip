@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Penumpang</h2>
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
                <th>penumpang_id</th>
                <th>nama_penumpang</th>
                <th>nik</th>
                <th>umur</th>
                <th>jenis_kelamin</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penumpang as $index => $item)
                <tr>
                    <td>{{ $penumpang->firstItem() + $index }}</td>
                    <td>{{ $item->penumpang_id }}</td>
                    <td class="fw-bold">{{ $item->nama_penumpang ?? '-' }}</td>
                    <td>{{ $item->nik ?? '-' }}</td>
                    <td>{{ $item->umur ?? '-' }}</td>
                    <td>
                        <span class="badge d-inline-block text-center
                            @if($item->jenis_kelamin == 'L') bg-primary
                            @elseif($item->jenis_kelamin == 'P') text-dark
                            @else bg-secondary
                            @endif" style="min-width: 90px; @if($item->jenis_kelamin == 'P') background-color: #FFB6C1; @endif">
                            @if($item->jenis_kelamin == 'L')
                                Laki-laki
                            @elseif($item->jenis_kelamin == 'P')
                                Perempuan
                            @else
                                -
                            @endif
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada data penumpang</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($penumpang->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $penumpang->links('pagination::bootstrap-5') }}
</div>
@endif

@endsection
