@extends('layout.admin')

@push('styles')
<link href="{{ asset('css/admin-user-form.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container-custom">
    <div class="header-section">
        <div class="header-icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <h4>Tambah User Baru</h4>
        <p>Lengkapi form untuk menambahkan user ke sistem</p>
    </div>

    @if ($errors->any())
    <div class="alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-card">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-user"></i>
                    Nama Lengkap
                </label>
                <input type="text" 
                       name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" 
                       placeholder="Masukkan nama lengkap"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-envelope"></i>
                    Email
                </label>
                <input type="email" 
                       name="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" 
                       placeholder="user@example.com"
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-lock"></i>
                    Password
                </label>
                <input type="password" 
                       name="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Minimal 8 karakter"
                       required
                       minlength="8">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-lock"></i>
                    Konfirmasi Password
                </label>
                <input type="password" 
                       name="password_confirmation" 
                       class="form-control" 
                       placeholder="Ulangi password"
                       required
                       minlength="8">
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-shield-alt"></i>
                    Role
                </label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="toggle-label">
                    <div class="toggle-switch">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </div>
                    <div>
                        <div class="form-label" style="margin-bottom: 0;">
                            <i class="fas fa-toggle-on"></i>
                            Status Aktif
                        </div>
                        <small class="text-muted" style="font-size: 12px;">User dapat login ke sistem</small>
                    </div>
                </label>
            </div>

            <div class="buttons-group">
                <a href="{{ route('users') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i>
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
