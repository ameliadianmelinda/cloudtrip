<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CloudTrip - Travel Agency')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-gray-50 font-inter">
    <!-- Header Navigation -->
    <header class="bg-white shadow-sm" style="position: sticky !important; top: 0 !important; z-index: 30 !important;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="CloudTrip Logo" class="h-8 w-auto">
                    <h1 class="text-xl font-bold" style="background: linear-gradient(to right, #FFB894, #FB9590, #DC586D, #A33757, #852E4E, #4C1D3D); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">CloudTrip</h1>
                </div>

                <!-- User Menu (After Login) -->
                <div class="flex items-center space-x-4">
                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <a href="{{ route('profile') }}" class="flex items-center text-gray-700 hover:text-gray-900 transition duration-200" style="gap: 8px;">
                            <span class="text-sm font-medium">{{ Auth::user()->name ?? 'User' }}</span>
                            <i class="fas fa-user-circle transition-all duration-300" style="font-size: 32px !important; background: linear-gradient(to right, #FFD4B8, #FFC2BC, #E893A7, #C67088, #A56B7A, #7A5C70); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; opacity: 0.8;" onmouseover="this.style.opacity='1'; this.style.transform='scale(1.1)'" onmouseout="this.style.opacity='0.8'; this.style.transform='scale(1)'"></i>
                        </a>

                        <!-- Dropdown Menu (Hidden by default, can be toggled with JavaScript) -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border py-1 hidden" id="userDropdown">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Bookings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <hr class="my-1">
                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">© 2026 CloudTrip Travel Agency. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>