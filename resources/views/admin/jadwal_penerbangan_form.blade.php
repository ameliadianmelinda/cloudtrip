@php use Carbon\Carbon; @endphp

<div class="mb-3">
    <label class="form-label">Pesawat</label>
    <select class="form-control @error('pesawat_id') is-invalid @enderror" name="pesawat_id">
        <option value="">-- Pilih Pesawat --</option>
        @foreach ($pesawat as $p)
            <option value="{{ $p->pesawat_id }}" {{ old('pesawat_id', optional($jadwal)->pesawat_id) == $p->pesawat_id ? 'selected' : '' }}>
                {{ $p->kode_pesawat }} - {{ $p->maskapai->nama_maskapai ?? $p->tipe_pesawat ?? '' }}
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
                <option value="{{ $b->bandara_id }}" {{ old('bandara_asal', optional($jadwal)->bandara_asal) == $b->bandara_id ? 'selected' : '' }}>{{ $b->nama_bandara }} ({{ $b->kota }})</option>
            @endforeach
        </select>
        @error('bandara_asal') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Bandara Tujuan</label>
        <select class="form-control @error('bandara_tujuan') is-invalid @enderror" name="bandara_tujuan">
            <option value="">-- Pilih Bandara Tujuan --</option>
            @foreach ($bandara as $b)
                <option value="{{ $b->bandara_id }}" {{ old('bandara_tujuan', optional($jadwal)->bandara_tujuan) == $b->bandara_id ? 'selected' : '' }}>{{ $b->nama_bandara }} ({{ $b->kota }})</option>
            @endforeach
        </select>
        @error('bandara_tujuan') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Tanggal Berangkat</label>
        <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror" name="tanggal_berangkat" value="{{ old('tanggal_berangkat', optional($jadwal)->tanggal_berangkat ? Carbon::parse($jadwal->tanggal_berangkat)->format('Y-m-d') : '') }}">
        @error('tanggal_berangkat') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Waktu Berangkat</label>
        <input type="time" class="form-control @error('waktu_berangkat') is-invalid @enderror" name="waktu_berangkat" value="{{ old('waktu_berangkat', optional($jadwal)->waktu_berangkat ? Carbon::parse($jadwal->waktu_berangkat)->format('H:i') : '') }}">
        @error('waktu_berangkat') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Waktu Tiba</label>
        <input type="time" class="form-control @error('waktu_tiba') is-invalid @enderror" name="waktu_tiba" value="{{ old('waktu_tiba', optional($jadwal)->waktu_tiba ? Carbon::parse($jadwal->waktu_tiba)->format('H:i') : '') }}">
        @error('waktu_tiba') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Harga</label>
    <input type="number" step="0.01" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga', optional($jadwal)->harga) }}">
    @error('harga') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select class="form-control @error('status') is-invalid @enderror" name="status">
        <option value="available" {{ old('status', optional($jadwal)->status) == 'available' ? 'selected' : '' }}>Available</option>
        <option value="cancel" {{ old('status', optional($jadwal)->status) == 'cancel' ? 'selected' : '' }}>Cancel</option>
        <option value="delay" {{ old('status', optional($jadwal)->status) == 'delay' ? 'selected' : '' }}>Delay</option>
    </select>
    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-danger">Simpan</button>
    <a href="{{ route('jadwal_penerbangan') }}" class="btn btn-secondary">Batal</a>
</div>
