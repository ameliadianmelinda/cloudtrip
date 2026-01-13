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
	<table class="table table-hover mb-0">
		<thead class="table-light">
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Pesawat</th>
				<th>Maskapai</th>
				<th>Asal</th>
				<th>Tujuan</th>
				<th>Berangkat</th>
				<th>Tiba</th>
				<th>Harga</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($jadwal as $j)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $j->tanggal_berangkat }}</td>
					<td>{{ $j->pesawat->kode_pesawat ?? '-' }}</td>
					<td>{{ $j->pesawat && $j->pesawat->maskapai ? $j->pesawat->maskapai->nama_maskapai : '-' }}</td>
					<td>{{ $j->bandaraAsal->nama_bandara ?? '-' }}</td>
					<td>{{ $j->bandaraTujuan->nama_bandara ?? '-' }}</td>
					<td>{{ $j->waktu_berangkat }}</td>
					<td>{{ $j->waktu_tiba }}</td>
					<td>Rp {{ number_format($j->harga,0,',','.') }}</td>
					<td>{{ ucfirst($j->status) }}</td>
					<td>
						<a href="{{ route('jadwal_penerbangan.edit', $j->jadwal_id) }}" class="btn btn-sm btn-warning">Edit</a>
						<form action="{{ route('jadwal_penerbangan.destroy', $j->jadwal_id) }}" method="POST" style="display:inline;">
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

