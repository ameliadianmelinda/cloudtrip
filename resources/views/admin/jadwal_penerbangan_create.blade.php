@extends('layout.admin')

@section('content')
<h2 class="fw-bold mb-4">Tambah Jadwal Penerbangan</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="bg-white rounded shadow p-4">
    <form action="{{ route('jadwal_penerbangan.store') }}" method="POST">
        @csrf
        @include('admin.jadwal_penerbangan_form', ['jadwal' => null])
    </form>
</div>
@endsection
