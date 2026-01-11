@extends('layout.admin')

<link href="{{ asset('css/admin-user-index.css') }}" rel="stylesheet">
@section('content')

    {{-- HEADER --}}
    <div class="top-header">
        <div class="header-left">
            <h4>Manajemen User</h4>
            <small>Kelola pengguna sistem CloudTrip</small>
        </div>

        <div class="header-right">
            <div class="search-box">
                <input type="text" placeholder="Cari user...">
                <i class="fas fa-search"></i>
            </div>
            <a href="{{ route('users.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="stats-grid">
        <div class="stat-card gradient">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-value">{{ $users->count() }}</div>
            <div class="stat-label">Total Users</div>
            <div class="stat-change up">
                <i class="fas fa-arrow-up"></i>
                <span>{{ $users->count() }} pengguna terdaftar</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-value">{{ $users->where('role','admin')->count() }}</div>
            <div class="stat-label">Admin</div>
            <div class="stat-change">
                <i class="fas fa-info-circle"></i>
                <span>Pengguna administrator</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="stat-value">{{ $users->where('role','staff')->count() }}</div>
            <div class="stat-label">Staff</div>
            <div class="stat-change">
                <i class="fas fa-info-circle"></i>
                <span>Pengguna staff</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-value">{{ $users->where('role','customer')->count() }}</div>
            <div class="stat-label">Customer</div>
            <div class="stat-change up">
                <i class="fas fa-arrow-up"></i>
                <span>Pengguna customer</span>
            </div>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="filter-section">
        <div class="section-title">Daftar User</div>
        <div class="filter-tabs">
            <button class="filter-tab active" data-filter="all" onclick="filterByRole('all')">Semua</button>
            <button class="filter-tab" data-filter="admin" onclick="filterByRole('admin')">Admin</button>
            <button class="filter-tab" data-filter="staff" onclick="filterByRole('staff')">Staff</button>
            <button class="filter-tab" data-filter="customer" onclick="filterByRole('customer')">Customer</button>
        </div>
    </div>

    {{-- USER CARDS --}}
    <div class="user-cards">
        @foreach ($users as $user)
            <div class="user-card" data-role="{{ $user->role }}">

                {{-- ROLE BADGE --}}
                <span class="role-badge role-{{ $user->role }}">
                    {{ strtoupper($user->role) }}
                </span>

                {{-- HEADER --}}
                <div class="user-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="user-details">
                            <h6>{{ $user->name }}</h6>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- META --}}
                <div class="user-meta">
                    <div class="meta-item">
                        <i class="fas fa-calendar"></i>
                        {{ $user->created_at->format('d M Y') }}
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-id-badge"></i>
                        ID: {{ $user->id }}
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-envelope"></i>
                        {{ $user->email }}
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="user-actions">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-action btn-delete"
                                onclick="return confirm('Yakin hapus user?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>

            </div>
        @endforeach
    </div>

<script>
function filterByRole(role) {
    const cards = document.querySelectorAll('.user-card');
    const tabs = document.querySelectorAll('.filter-tab');
    
    // Update active tab
    tabs.forEach(tab => tab.classList.remove('active'));
    document.querySelector(`[data-filter="${role}"]`).classList.add('active');
    
    // Filter cards
    cards.forEach(card => {
        if (role === 'all' || card.dataset.role === role) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

@endsection
