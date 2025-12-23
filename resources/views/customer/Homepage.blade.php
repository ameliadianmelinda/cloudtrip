<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CloudTrip - Travel Agency</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-inter">
    <!-- Header Navigation -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="CloudTrip Logo" class="h-8 w-auto">
                    <h1 class="text-xl font-bold" style="background: linear-gradient(to right, #FFB894, #FB9590, #DC586D, #A33757, #852E4E, #4C1D3D); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">CloudTrip</h1>
                </div>
                
                <!-- Sign In Button -->
                <button class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800 transition duration-200">
                    Sign in
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-12" style="background: linear-gradient(135deg, #FFF8E7 0%, #FFE8E5 50%, #F8E8F0 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-6">
                <p class="text-sm text-gray-600 mb-3 uppercase tracking-wide">READY TAKE-OFF</p>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                    CONVENIENT ONLINE<br>
                    <span class="text-blue-600">FLIGHT BOOKING SERVICES</span>
                </h1>
                
                <!-- Airplane Image -->
                <div class="flex justify-center mb-6 relative">
                    <div class="flex items-center justify-center" style="width: 550px; height: 250px;">
                        <img src="{{ asset('images/pesawat.png') }}" alt="Airplane" class="w-full h-full object-contain drop-shadow-2xl">
                    </div>
                </div>
            </div>
            
            <!-- Flight Search Form -->
            <div class="bg-white rounded-2xl shadow-lg p-6 max-w-4xl mx-auto">
                <div class="flex flex-wrap gap-2 mb-5">
                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-medium">One Way</button>
                    <button class="text-gray-600 px-4 py-2 rounded-full text-sm hover:bg-gray-100">Round Trip</button>
                    <button class="text-gray-600 px-4 py-2 rounded-full text-sm hover:bg-gray-100">Multi City</button>
                </div>
                
                <div class="flex flex-wrap gap-2 items-end">
                    <!-- From -->
                    <div class="flex-1">
                        <label class="block text-sm text-gray-600 mb-1">From</label>
                        <div class="relative">
                            <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option>Tokyo, Japan</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Swap Icon -->
                    <div class="flex-shrink-0 flex items-center justify-center mb-3">
                        <button class="bg-blue-100 hover:bg-blue-200 p-3 rounded-full transition duration-200">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- To -->
                    <div class="flex-1">
                        <label class="block text-sm text-gray-600 mb-1">To</label>
                        <div class="relative">
                            <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option>Berlin, Germany</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Departure -->
                    <div class="flex-1">
                        <label class="block text-sm text-gray-600 mb-1">Departure</label>
                        <input type="date" value="2023-10-11" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <!-- Return -->
                    <div class="flex-1">
                        <label class="block text-sm text-gray-600 mb-1">Return</label>
                        <input type="date" value="2023-12-15" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <!-- Search Button -->
                    <div class="flex-shrink-0 flex items-center justify-center mb-3">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Flight Deals Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Title -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">TOP FLIGHT DEALS</h2>
                <p class="text-gray-600">
                    Discover top flight deals for elite travel experiences at<br>unprecedented prices.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 h-80">

                <!-- LEFT CARD (Luxury Travel Horizontal) -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden flex w-full lg:w-[45%] h-full">
                    <div class="w-[50%]">
                        <img src="{{ asset('images/kursi_pswt.jpg') }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="w-[50%] p-6 flex flex-col justify-center">
                        <p class="text-sm text-gray-500 mb-2 font-medium tracking-wider">DTOUR2023</p>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight">
                            LUXURY TRAVEL AND<br>AIRLINES
                        </h3>

                        <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                            Luxury travel and airlines offer opulence, comfort, and
                            exclusivity for discerning travellers.
                        </p>

                        <button class="bg-blue-300 text-white px-6 py-2 rounded-full hover:bg-blue-400 transition">
                            Learn More
                        </button>
                    </div>
                </div>

                <!-- RIGHT COLUMN (2 vertical cards) -->
                <div class="flex flex-col lg:flex-row gap-6 w-full lg:w-[55%]">

                    <!-- HOTEL BOOKINGS -->
                    <div class="relative rounded-3xl shadow-lg overflow-hidden flex-1 h-full">
                        <img src="{{ asset('images/pesawat-1.jpg') }}"
                            class="absolute inset-0 w-full h-full object-cover">

                        <!-- gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                            <h3 class="text-white text-lg font-bold">HOTEL BOOKINGS</h3>

                            <button class="bg-blue-300 hover:bg-blue-200 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 17l9.2-9.2M17 17V7H7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- BOOK DOMESTIC -->
                    <div class="relative rounded-3xl shadow-lg overflow-hidden flex-1 h-full">
                        <img src="{{ asset('images/pesawat-2.jpg') }}"
                            class="absolute inset-0 w-full h-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                            <h3 class="text-white text-lg font-bold">BOOK DOMESTIC</h3>

                            <button class="bg-blue-300 hover:bg-blue-200 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 17l9.2-9.2M17 17V7H7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Most Popular Airlines Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">MOST POPULAR AIRLINES</h2>
                <p class="text-gray-600">The world's leading airlines offer top-notch service, ensuring<br>memorable travel experiences for passengers.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                <!-- Philippine Airlines -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition duration-200">
                    <div class="h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900">PHILIPPINE</h3>
                </div>
                
                <!-- Turkish Airlines -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition duration-200">
                    <div class="h-20 bg-gradient-to-br from-red-400 to-red-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900">TURKISH AIRLINES</h3>
                </div>
                
                <!-- Emirates -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition duration-200">
                    <div class="h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900">EMIRATES</h3>
                    <button class="mt-2 bg-blue-500 text-white w-8 h-8 rounded-full">
                        →
                    </button>
                </div>
                
                <!-- Qatar Airways -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition duration-200">
                    <div class="h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900">QATAR AIRWAYS</h3>
                </div>
                
                <!-- Additional Airline Slot -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition duration-200">
                    <div class="h-20 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900">AIRLINES</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Book Your Hotel Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">BOOK YOUR HOTEL</h2>
                <p class="text-gray-600">The world's leading airlines offer top-notch service, ensuring<br>memorable travel experiences for passengers.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Hotel 1 - Moxy NYC Downtown -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-200">
                    <div class="h-64 bg-gradient-to-br from-blue-400 to-indigo-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold mb-2">MOXY NYC DOWNTOWN</h3>
                        </div>
                    </div>
                </div>

                <!-- Hotel 2 - Hotel Tropical Daisy -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-200">
                    <div class="h-64 bg-gradient-to-br from-cyan-400 to-blue-500 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold mb-1">HOTEL TROPICAL DAISY</h3>
                            <p class="text-sm opacity-90">Lorem ipsum short caption</p>
                            <button class="mt-2 bg-black text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800 transition duration-200">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hotel 3 - Hotel Tropical Daisy -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-200">
                    <div class="h-64 bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold mb-2">HOTEL TROPICAL DAISY</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">© 2024 CloudTrip Travel Agency. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>