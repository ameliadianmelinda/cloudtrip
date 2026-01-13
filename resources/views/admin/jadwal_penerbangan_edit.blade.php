@extends('layout.admin')

@section('content')
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
        
        <div class="mb-3">
            <label class="form-label">Pesawat</label>
            <select class="form-select @error('pesawat_id') is-invalid @enderror" name="pesawat_id">
                <option value="">Pilih Pesawat</option>
                @foreach ($pesawat as $p)
                    <option value="{{ $p->pesawat_id }}" {{ (old('pesawat_id') ?? $jadwal->pesawat_id) == $p->pesawat_id ? 'selected' : '' }}>
                        {{ $p->kode_pesawat }} - {{ $p->tipe_pesawat }}
                    </option>
                @endforeach
            </select>
            @error('pesawat_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Bandara Asal</label>
            <select class="form-select @error('bandara_asal') is-invalid @enderror" name="bandara_asal">
                <option value="">Pilih Bandara Asal</option>
                @foreach ($bandara as $b)
                    <option value="{{ $b->bandara_id }}" {{ (old('bandara_asal') ?? $jadwal->bandara_asal) == $b->bandara_id ? 'selected' : '' }}>
                        {{ $b->nama_bandara }}
                    </option>
                @endforeach
            </select>
            @error('bandara_asal')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Bandara Tujuan</label>
            <select class="form-select @error('bandara_tujuan') is-invalid @enderror" name="bandara_tujuan">
                <option value="">Pilih Bandara Tujuan</option>
                @foreach ($bandara as $b)
                    <option value="{{ $b->bandara_id }}" {{ (old('bandara_tujuan') ?? $jadwal->bandara_tujuan) == $b->bandara_id ? 'selected' : '' }}>
                        {{ $b->nama_bandara }}
                    </option>
                @endforeach
            </select>
            @error('bandara_tujuan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Berangkat</label>
            <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror" 
                name="tanggal_berangkat" value="{{ old('tanggal_berangkat', $jadwal->tanggal_berangkat ? $jadwal->tanggal_berangkat->format('Y-m-d') : '') }}">
            @error('tanggal_berangkat')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu Berangkat</label>
            <input type="time" class="form-control @error('waktu_berangkat') is-invalid @enderror" 
                name="waktu_berangkat" value="{{ old('waktu_berangkat', $jadwal->waktu_berangkat ? $jadwal->waktu_berangkat->format('H:i') : '') }}">
            @error('waktu_berangkat')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu Tiba</label>
            <input type="time" class="form-control @error('waktu_tiba') is-invalid @enderror" 
                name="waktu_tiba" value="{{ old('waktu_tiba', $jadwal->waktu_tiba ? $jadwal->waktu_tiba->format('H:i') : '') }}">
            @error('waktu_tiba')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                name="harga" value="{{ old('harga', $jadwal->harga) }}" step="0.01">
            @error('harga')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" name="status">
                <option value="available" {{ (old('status') ?? $jadwal->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="cancel" {{ (old('status') ?? $jadwal->status) == 'cancel' ? 'selected' : '' }}>Cancel</option>
                <option value="delay" {{ (old('status') ?? $jadwal->status) == 'delay' ? 'selected' : '' }}>Delay</option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Simpan</button>
            <a href="{{ route('jadwal_penerbangan') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
@extends('layout.admin')

@section('content')
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

        <div class="mb-3">
            <label class="form-label">Pesawat</label>
            <select class="form-control @error('pesawat_id') is-invalid @enderror" name="pesawat_id">
                <option value="">-- Pilih Pesawat --</option>
                @foreach ($pesawat as $p)
                    <option value="{{ $p->pesawat_id }}" {{ old('pesawat_id', $jadwal->pesawat_id) == $p->pesawat_id ? 'selected' : '' }}>
                        {{ $p->kode_pesawat }} - {{ $p->maskapai->nama_maskapai ?? '' }}
                    </option>
                @endforeach
            </select>
            @error('pesawat_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Bandara Asal</label>
                <select class="form-control @error('bandara_asal') is-invalid @enderror" name="bandara_asal">
                    <option value="">-- Pilih Bandara Asal --</option>
                    @foreach ($bandara as $b)
                        <option value="{{ $b->bandara_id }}" {{ old('bandara_asal', $jadwal->bandara_asal) == $b->bandara_id ? 'selected' : '' }}>{{ $b->nama_bandara }} ({{ $b->kota }})</option>
                    @endforeach
                </select>
                @error('bandara_asal') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Bandara Tujuan</label>
                <select class="form-control @error('bandara_tujuan') is-invalid @enderror" name="bandara_tujuan">
                    <option value="">-- Pilih Bandara Tujuan --</option>
                    @foreach ($bandara as $b)
                        <option value="{{ $b->bandara_id }}" {{ old('bandara_tujuan', $jadwal->bandara_tujuan) == $b->bandara_id ? 'selected' : '' }}>{{ $b->nama_bandara }} ({{ $b->kota }})</option>
                    @endforeach
                </select>
                @error('bandara_tujuan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Berangkat</label>
                <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror" name="tanggal_berangkat" value="{{ old('tanggal_berangkat', $jadwal->tanggal_berangkat ? \Carbon\Carbon::parse($jadwal->tanggal_berangkat)->format('Y-m-d') : '') }}">
                @error('tanggal_berangkat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Waktu Berangkat</label>
                <input type="time" class="form-control @error('waktu_berangkat') is-invalid @enderror" name="waktu_berangkat" value="{{ old('waktu_berangkat', $jadwal->waktu_berangkat ? \Carbon\Carbon::parse($jadwal->waktu_berangkat)->format('H:i') : '') }}">
                @error('waktu_berangkat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Waktu Tiba</label>
                <input type="time" class="form-control @error('waktu_tiba') is-invalid @enderror" name="waktu_tiba" value="{{ old('waktu_tiba', $jadwal->waktu_tiba ? \Carbon\Carbon::parse($jadwal->waktu_tiba)->format('H:i') : '') }}">
                @error('waktu_tiba') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" step="0.01" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga', $jadwal->harga) }}">
            @error('harga') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" name="status">
                <option value="available" {{ old('status', $jadwal->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="cancel" {{ old('status', $jadwal->status) == 'cancel' ? 'selected' : '' }}>Cancel</option>
                <option value="delay" {{ old('status', $jadwal->status) == 'delay' ? 'selected' : '' }}>Delay</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Simpan</button>
            <a href="{{ route('jadwal_penerbangan') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
