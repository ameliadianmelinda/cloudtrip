@extends('layout.admin')

@section('content')
<h2 class="fw-bold mb-4">Edit Maskapai</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="bg-white rounded shadow p-4">
    <form action="{{ route('maskapai.update', $maskapai->maskapai_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Kode Maskapai</label>
            <input type="text" class="form-control @error('kode_maskapai') is-invalid @enderror" 
                name="kode_maskapai" value="{{ old('kode_maskapai', $maskapai->kode_maskapai) }}">
            @error('kode_maskapai')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Maskapai</label>
            <input type="text" class="form-control @error('nama_maskapai') is-invalid @enderror" 
                name="nama_maskapai" value="{{ old('nama_maskapai', $maskapai->nama_maskapai) }}">
            @error('nama_maskapai')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                name="logo" accept="image/*">
            @if($maskapai->logo)
                <div class="mt-2">
                    <img src="{{ asset($maskapai->logo) }}" alt="logo" width="80">
                </div>
            @endif
            @error('logo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Update</button>
            <a href="{{ route('maskapai') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
