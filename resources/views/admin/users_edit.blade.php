@extends('layout.admin')

@push('styles')
<link href="{{ asset('css/admin-user-edit.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container-custom">
    <div class="header-section">
        <div class="header-icon">
            <i class="fas fa-user-edit"></i>
        </div>
        <h4>Edit User</h4>
        <p>Perbarui informasi user</p>
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

    <div class="alert-info">
        <i class="fas fa-info-circle"></i>
        <p><strong>Catatan:</strong> Kosongkan field password jika tidak ingin mengubah password. Password hanya akan diubah jika Anda mengisi field password dengan nilai baru.</p>
    </div>

    <div class="form-card">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-user"></i>
                    Nama Lengkap
                </label>
                <input type="text" 
                       name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $user->name) }}" 
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
                       value="{{ old('email', $user->email) }}" 
                       placeholder="user@example.com"
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-lock"></i>
                    Password Baru (Opsional)
                </label>
                <input type="password" 
                       name="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Kosongkan jika tidak ingin mengubah"
                       minlength="8">
                <small class="text-muted" style="font-size: 12px;">Minimal 8 karakter jika diisi</small>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-shield-alt"></i>
                    Role
                </label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="toggle-label">
                    <div class="toggle-switch">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
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
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
