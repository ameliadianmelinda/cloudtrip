@extends('layout.admin')

@section('content')

<h2 class="fw-bold mb-4">Dashboard Admin</h2>

<div class="row g-4">
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon"><i class="bi bi-airplane"></i></div>
            <div>
                <h5>Maskapai</h5>
                <h3>{{ $totalMaskapai }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon"><i class="bi bi-geo-alt-fill"></i></div>
            <div>
                <h5>Bandara</h5>
                <h3>{{ $totalBandara }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon"><i class="bi bi-airplane-engines"></i></div>
            <div>
                <h5>Pesawat</h5>
                <h3>{{ $totalPesawat }}</h3>
            </div>
        </div>
    </div>
</div>

@endsection
