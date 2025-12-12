@extends('layout.admin')

@section('content')
<h2 class="fw-bold mb-4">Edit Pesawat</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="bg-white rounded shadow p-4">
    <form action="{{ route('pesawat.update', $pesawat->pesawat_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Kode Pesawat</label>
            <input type="text" class="form-control @error('kode_pesawat') is-invalid @enderror" 
                name="kode_pesawat" value="{{ old('kode_pesawat', $pesawat->kode_pesawat) }}">
            @error('kode_pesawat')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe Pesawat</label>
            <input type="text" class="form-control @error('tipe_pesawat') is-invalid @enderror" 
                name="tipe_pesawat" value="{{ old('tipe_pesawat', $pesawat->tipe_pesawat) }}">
            @error('tipe_pesawat')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Maskapai</label>
            <select class="form-control @error('maskapai_id') is-invalid @enderror" name="maskapai_id">
                <option value="">-- Pilih Maskapai --</option>
                @foreach ($maskapai as $item)
                    <option value="{{ $item->maskapai_id }}" {{ old('maskapai_id', $pesawat->maskapai_id) == $item->maskapai_id ? 'selected' : '' }}>
                        {{ $item->nama_maskapai }}
                    </option>
                @endforeach
            </select>
            @error('maskapai_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Kapasitas</label>
            <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" 
                name="kapasitas" value="{{ old('kapasitas', $pesawat->kapasitas) }}">
            @error('kapasitas')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Update</button>
            <a href="{{ route('pesawat') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
