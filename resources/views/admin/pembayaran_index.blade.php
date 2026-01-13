@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Pembayaran</h2>
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
                <th>pembayaran_id</th>
                <th>pemesanan_id</th>
                <th>metode</th>
                <th>jumlah</th>
                <th>status</th>
                <th>tanggal_bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembayaran as $index => $item)
                <tr>
                    <td>{{ $pembayaran->firstItem() + $index }}</td>
                    <td>{{ $item->pembayaran_id }}</td>
                    <td>{{ $item->pemesanan_id ?? '-' }}</td>
                    <td>
                        <span class="badge d-inline-block text-center
                            @if($item->metode == 'transfer') bg-primary
                            @elseif($item->metode == 'qris') bg-info text-dark
                            @elseif($item->metode == 'va') bg-secondary
                            @else bg-light text-dark
                            @endif" style="min-width: 70px;">
                            {{ $item->metode ?? '-' }}
                        </span>
                    </td>
                    <td class="text-nowrap">Rp {{ number_format($item->jumlah ?? 0, 2, ',', '.') }}</td>
                    <td>
                        <span class="badge d-inline-block text-center
                            @if($item->status == 'success') bg-success
                            @elseif($item->status == 'failed') bg-danger
                            @else bg-warning text-dark
                            @endif" style="min-width: 70px;">
                            {{ $item->status ?? 'pending' }}
                        </span>
                    </td>
                    <td class="text-nowrap">{{ $item->tanggal_bayar ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Belum ada data pembayaran</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($pembayaran->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $pembayaran->links('pagination::bootstrap-5') }}
</div>
@endif

@endsection
