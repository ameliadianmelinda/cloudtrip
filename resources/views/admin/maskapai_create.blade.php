@extends('layout.admin')

@section('content')
<h2 class="fw-bold mb-4">Tambah Maskapai</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="bg-white rounded shadow p-4">
    <form action="{{ route('maskapai.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Kode Maskapai</label>
            <input type="text" class="form-control @error('kode_maskapai') is-invalid @enderror" 
                name="kode_maskapai" value="{{ old('kode_maskapai') }}">
            @error('kode_maskapai')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Maskapai</label>
            <input type="text" class="form-control @error('nama_maskapai') is-invalid @enderror" 
                name="nama_maskapai" value="{{ old('nama_maskapai') }}">
            @error('nama_maskapai')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                name="logo" accept="image/*">
            @error('logo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Simpan</button>
            <a href="{{ route('maskapai') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
