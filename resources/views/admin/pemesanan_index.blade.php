@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Pemesanan</h2>
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
                <th>pemesanan_id</th>
                <th>kode_pemesanan</th>
                <th>user_id</th>
                <th>jadwal_id</th>
                <th>tanggal_pesan</th>
                <th>total_harga</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pemesanan as $index => $item)
                <tr>
                    <td>{{ $pemesanan->firstItem() + $index }}</td>
                    <td>{{ $item->pemesanan_id }}</td>
                    <td class="fw-bold">{{ $item->kode_pemesanan ?? '-' }}</td>
                    <td>{{ $item->user_id }}</td>
                    <td>{{ $item->jadwal_id }}</td>
                    <td class="text-nowrap">{{ $item->tanggal_pesan }}</td>
                    <td class="text-nowrap">Rp {{ number_format($item->total_harga ?? 0, 2, ',', '.') }}</td>
                    <td>
                        <span class="badge d-inline-block text-center
                            @if($item->status == 'paid') bg-success
                            @elseif($item->status == 'cancel') bg-danger
                            @else bg-warning text-dark
                            @endif" style="min-width: 70px;">
                            {{ $item->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4">Belum ada data pemesanan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($pemesanan->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $pemesanan->links('pagination::bootstrap-5') }}
</div>
@endif

@endsection
