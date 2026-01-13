<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CloudTrip - Travel Agency')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
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

                <!-- Sign In Button -->
                <a href="{{ route('login') }}"
                   class="text-white px-6 py-2 rounded-full transition-all duration-300 inline-block text-center hover:shadow-lg"
                   style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.85) 0%, rgba(251, 149, 144, 0.85) 25%, rgba(220, 88, 109, 0.85) 50%, rgba(163, 55, 87, 0.85) 75%, rgba(76, 29, 61, 0.85) 100%);"
                   onmouseover="this.style.background='linear-gradient(135deg, #FFB894 0%, #FB9590 25%, #DC586D 50%, #A33757 75%, #4C1D3D 100%)'"
                   onmouseout="this.style.background='linear-gradient(135deg, rgba(255, 184, 148, 0.85) 0%, rgba(251, 149, 144, 0.85) 25%, rgba(220, 88, 109, 0.85) 50%, rgba(163, 55, 87, 0.85) 75%, rgba(76, 29, 61, 0.85) 100%)'">
                    Sign in
                </a>
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
