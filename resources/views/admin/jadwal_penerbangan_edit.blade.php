@extends('layout.admin')

@section('content')
@php use Carbon\Carbon; @endphp
<h2 class="fw-bold mb-4">Edit Jadwal Penerbangan</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="bg-white rounded shadow p-4">
    <form action="{{ route('jadwal_penerbangan.update', $jadwal->jadwal_id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.jadwal_penerbangan_form', ['jadwal' => $jadwal])
    </form>
</div>
@endsection

