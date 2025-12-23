@extends('layout.admin')

@section('content')
<h2 class="fw-bold mb-4">Edit Bandara</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="bg-white rounded shadow p-4">
    <form action="{{ route('bandara.update', $bandara->bandara_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Kode Bandara</label>
            <input type="text" class="form-control @error('kode_bandara') is-invalid @enderror" 
                name="kode_bandara" value="{{ old('kode_bandara', $bandara->kode_bandara) }}">
            @error('kode_bandara')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Bandara</label>
            <input type="text" class="form-control @error('nama_bandara') is-invalid @enderror" 
                name="nama_bandara" value="{{ old('nama_bandara', $bandara->nama_bandara) }}">
            @error('nama_bandara')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Kota</label>
            <input type="text" class="form-control @error('kota') is-invalid @enderror" 
                name="kota" value="{{ old('kota', $bandara->kota) }}">
            @error('kota')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Negara</label>
            <input type="text" class="form-control @error('negara') is-invalid @enderror" 
                name="negara" value="{{ old('negara', $bandara->negara) }}">
            @error('negara')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Update</button>
            <a href="{{ route('bandara') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
