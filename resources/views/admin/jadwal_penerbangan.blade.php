@extends('layout.admin')

@section('content')
@php use Carbon\Carbon; @endphp
<div class="d-flex justify-content-between align-items-center mb-4">
	<h2 class="fw-bold">Jadwal Penerbangan</h2>
	<a href="{{ route('jadwal_penerbangan.create') }}" class="btn btn-danger">+ Tambah Jadwal</a>
</div>

@if (session('success'))
	<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row mb-4">
	<div class="col-md-3">
		<div class="card-section">
			<h6 class="text-muted">Total Jadwal</h6>
			<h3 class="fw-bold">{{ $summary['total'] ?? 0 }}</h3>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card-section">
			<h6 class="text-muted">Available</h6>
			<h3 class="fw-bold text-success">{{ $summary['available'] ?? 0 }}</h3>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card-section">
			<h6 class="text-muted">Delay</h6>
			<h3 class="fw-bold text-warning">{{ $summary['delay'] ?? 0 }}</h3>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card-section">
			<h6 class="text-muted">Cancel</h6>
			<h3 class="fw-bold text-danger">{{ $summary['cancel'] ?? 0 }}</h3>
		</div>
	</div>
</div>

<div class="table-responsive bg-white rounded shadow-sm p-3">
	<table class="table table-striped table-hover align-middle mb-0">
		<thead class="table-light">
			<tr>
				<th class="text-center" style="width:48px">No</th>
				<th>Tanggal</th>
				<th>Pesawat</th>
				<th>Maskapai</th>
				<th>Asal</th>
				<th>Tujuan</th>
				<th class="text-center">Berangkat</th>
				<th class="text-center">Tiba</th>
				<th class="text-end">Harga</th>
				<th class="text-center">Status</th>
				<th class="text-center" style="width:120px">Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($jadwal as $j)
				<tr>
					<td class="text-center">{{ $loop->iteration }}</td>
					<td>{{ Carbon::parse($j->tanggal_berangkat)->format('d M Y') }}</td>
					<td class="fw-bold text-uppercase">{{ $j->pesawat->kode_pesawat ?? '-' }}</td>
					<td>{{ $j->pesawat && $j->pesawat->maskapai ? $j->pesawat->maskapai->nama_maskapai : '-' }}</td>
					<td>{{ $j->bandaraAsal->nama_bandara ?? '-' }}</td>
					<td>{{ $j->bandaraTujuan->nama_bandara ?? '-' }}</td>
					<td class="text-center text-muted">{{ Carbon::parse($j->waktu_berangkat)->format('H:i') }}</td>
					<td class="text-center text-muted">{{ Carbon::parse($j->waktu_tiba)->format('H:i') }}</td>
					<td class="text-end">
						<div class="d-flex justify-content-end align-items-center" style="white-space:nowrap;">
							<span class="text-muted me-2">Rp</span>
							<span class="fw-bold">{{ number_format($j->harga,0,',','.') }}</span>
						</div>
					</td>
					<td class="text-center">
						@if(strtolower($j->status) === 'available')
							<span class="badge bg-success">Available</span>
						@elseif(strtolower($j->status) === 'delay')
							<span class="badge bg-warning text-dark">Delay</span>
						@elseif(strtolower($j->status) === 'cancel')
							<span class="badge bg-danger">Cancel</span>
						@else
							<span class="badge bg-secondary">{{ ucfirst($j->status) }}</span>
						@endif
					</td>
					<td class="text-center">
						<div class="d-flex justify-content-center gap-1">
							<a href="{{ route('jadwal_penerbangan.edit', $j->jadwal_id) }}" class="btn btn-sm btn-warning">Edit</a>
							<form action="{{ route('jadwal_penerbangan.destroy', $j->jadwal_id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection

