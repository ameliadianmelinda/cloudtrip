<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CloudTrip Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --c1: #FFBB94;
            --c2: #FB9590;
            --c3: #DC586D;
            --c4: #A33757;
            --c5: #852E4E;
            --c6: #4C1D3D;
        }

        body {
            background: #ffffff;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: linear-gradient(to bottom, var(--c6), var(--c4));
            padding: 0;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 3px 0 20px rgba(0,0,0,0.25);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 25px 15px;
            flex-shrink: 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logo {
            width: 75px;
            display: block;
            margin: 0 auto 15px auto;
        }

        .sidebar-title {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            color: #fff;
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 15px 10px;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.3);
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            margin-bottom: 6px;
            border-radius: 8px;
            font-size: 13px;
            color: #fff;
            text-decoration: none;
            transition: 0.2s;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.15);
            transform: translateX(4px);
        }

        .menu-active {
            background: var(--c3);
            font-weight: 600;
        }

        .menu-item i {
            margin-right: 10px;
            font-size: 16px;
            width: 16px;
            flex-shrink: 0;
        }

        .main-content {
            margin-left: 260px;
            padding: 35px 40px;
        }

        .topbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .profile-bubble {
            width: 45px;
            height: 45px;
            background: var(--c4);
            border-radius: 50%;
        }

        .dashboard-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
        }

        .dashboard-icon {
            font-size: 40px;
            color: var(--c3);
        }

        .dashboard-card h5 {
            margin: 0;
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }

        .dashboard-card h3 {
            margin: 5px 0 0 0;
            color: var(--c3);
            font-weight: 700;
        }
    </style>
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin-users.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo.png') }}" class="sidebar-logo" alt="CloudTrip Logo">
            <div class="sidebar-title">CloudTrip</div>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->is('dashboard') ? 'menu-active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('maskapai') }}" class="menu-item {{ request()->is('maskapai*') ? 'menu-active' : '' }}">
                <i class="bi bi-airplane"></i> Maskapai
            </a>
            <a href="{{ route('bandara') }}" class="menu-item {{ request()->is('bandara*') ? 'menu-active' : '' }}">
                <i class="bi bi-geo-alt-fill"></i> Bandara
            </a>
            <a href="{{ route('pesawat') }}" class="menu-item {{ request()->is('pesawat*') ? 'menu-active' : '' }}">
                <i class="bi bi-airplane-engines"></i> Pesawat
            </a>
            <a href="{{ route('admin.pemesanan.index') }}" class="menu-item {{ request()->is('admin/pemesanan*') ? 'menu-active' : '' }}">
                <i class="bi bi-receipt"></i> Pemesanan
            </a>
            <a href="{{ route('users') }}" class="menu-item {{ request()->is('users*') ? 'menu-active' : '' }}">
                <i class="bi bi-people"></i> Users
            </a> 
            <a href="{{ route('jadwal_penerbangan') }}" class="menu-item {{ request()->is('jadwal_penerbangan*') ? 'menu-active' : '' }}">
                <i class="bi bi-calendar3"></i> Jadwal Penerbangan
            </a>
            <a href="{{ route('laporan') }}" class="menu-item {{ request()->is('laporan*') ? 'menu-active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Laporan
            </a>
            <a href="{{ route('logout') }}" class="menu-item">
                <i class="bi bi-box-arrow-left"></i> Logout
            </a>
        </div>
    </div>
    <div class="main-content">
        <div class="topbar">
            <div>{{ auth()->user()->username ?? 'Admin' }}</div>
            <div class="profile-bubble"></div>
        </div>
        @yield('content')
        @stack('scripts')
    </div>
</body>
</html>
