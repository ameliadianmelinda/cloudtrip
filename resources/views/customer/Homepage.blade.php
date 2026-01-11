@extends(Auth::check() ? 'layout.Header-cust-auth' : 'layout.Header-cust')

@section('title', 'Homepage - CloudTrip Travel Agency')

@section('content')
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
            <div class="bg-white rounded-2xl shadow-lg p-6 max-w-4xl mx-auto relative z-40">

                <!-- Display validation errors -->
                @if($errors->any())
                    <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('search.flights') }}" method="POST" id="flightSearchForm">
                    @csrf
                    <input type="hidden" name="trip_type" id="tripType" value="one_way">

                    <div class="flex flex-wrap gap-2 mb-4">
                        <button type="button" id="oneWayBtn" class="px-4 py-2 rounded-full text-sm font-medium transition duration-300"
                                style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%); color: #4B5563;">One Way</button>
                        <button type="button" id="roundTripBtn" class="text-gray-600 px-4 py-2 rounded-full text-sm hover:bg-gray-100 transition duration-300">Round Trip</button>
                    </div>

                    <div class="flex flex-wrap gap-2 items-center">
                        <!-- From -->
                        <div class="flex-1">
                            <label class="block text-sm text-gray-600 mb-1">From</label>
                            <div class="relative z-50">
                                <select name="from" class="w-full p-3 pr-12 pl-4 border @error('from') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white" required>
                                    <option value="">Select departure city</option>
                                    @foreach($bandaras as $bandara)
                                        <option value="{{ $bandara->nama_bandara }}" {{ old('from') == $bandara->nama_bandara ? 'selected' : '' }}>{{ $bandara->nama_bandara }}, {{ $bandara->negara }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Swap Icon -->
                        <div class="flex-shrink-0 flex items-center justify-center" style="margin-top: 24px;">
                            <button type="button" id="swapBtn" class="h-14 w-14 rounded-full transition duration-300 hover:scale-105 hover:shadow-lg transform flex items-center justify-center"
                                    style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%);">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                            </button>
                        </div>

                        <!-- To -->
                        <div class="flex-1">
                            <label class="block text-sm text-gray-600 mb-1">To</label>
                            <div class="relative z-50">
                                <select name="to" class="w-full p-3 pr-12 pl-4 border @error('to') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white" required>
                                    <option value="">Select destination city</option>
                                    @foreach($bandaras as $bandara)
                                        <option value="{{ $bandara->nama_bandara }}" {{ old('to') == $bandara->nama_bandara ? 'selected' : '' }}>{{ $bandara->nama_bandara }}, {{ $bandara->negara }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Departure -->
                        <div class="flex-1">
                            <label class="block text-sm text-gray-600 mb-1">Departure</label>
                            <input type="date" name="departure_date" value="{{ old('departure_date', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+2 years')) }}" class="w-full p-3 border @error('departure_date') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>

                        <!-- Return -->
                        <div id="returnDateField" class="flex-1 hidden">
                            <label class="block text-sm text-gray-600 mb-1">Return</label>
                            <input type="date" name="return_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" max="{{ date('Y-m-d', strtotime('+2 years')) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Search Button -->
                        <div class="flex-shrink-0 flex items-center justify-center" style="margin-top: 24px;">
                            <button type="submit" class="h-14 w-14 rounded-full transition-all duration-300 hover:scale-110 hover:shadow-xl transform flex items-center justify-center hover:shadow-pink-200 hover:bg-opacity-50"
                                    style="background: linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%);"
                                    onmouseover="this.style.background='linear-gradient(135deg, rgba(255, 184, 148, 0.6) 0%, rgba(251, 149, 144, 0.6) 25%, rgba(220, 88, 109, 0.6) 50%, rgba(163, 55, 87, 0.6) 75%, rgba(76, 29, 61, 0.6) 100%)'"
                                    onmouseout="this.style.background='linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%)'">
                                <svg class="w-6 h-6 text-gray-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
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
@endsection

@push('scripts')
<script>
    // Get trip type buttons and return date field
    const oneWayBtn = document.getElementById('oneWayBtn');
    const roundTripBtn = document.getElementById('roundTripBtn');
    const returnDateField = document.getElementById('returnDateField');
    const tripTypeInput = document.getElementById('tripType');
    const swapBtn = document.getElementById('swapBtn');
    const fromSelect = document.querySelector('select[name="from"]');
    const toSelect = document.querySelector('select[name="to"]');
    const departureDateInput = document.querySelector('input[name="departure_date"]');
    const returnDateInput = document.querySelector('input[name="return_date"]');

    // Function to update return date minimum based on departure date
    function updateReturnDateMin() {
        if (departureDateInput.value) {
            const departureDate = new Date(departureDateInput.value);
            const nextDay = new Date(departureDate);
            nextDay.setDate(nextDay.getDate() + 1);
            const minReturnDate = nextDay.toISOString().split('T')[0];
            returnDateInput.setAttribute('min', minReturnDate);

            // If current return date is before new minimum, update it
            if (returnDateInput.value && returnDateInput.value <= departureDateInput.value) {
                returnDateInput.value = minReturnDate;
            }
        }
    }

    // Function to handle One Way selection
    function selectOneWay() {
        // Update button styles
        oneWayBtn.className = 'px-4 py-2 rounded-full text-sm font-medium transition duration-300';
        oneWayBtn.style.cssText = 'background: linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%); color: #4B5563;';
        roundTripBtn.className = 'text-gray-600 px-4 py-2 rounded-full text-sm hover:bg-gray-100 transition duration-300';
        roundTripBtn.style.cssText = '';

        // Hide return date field
        returnDateField.classList.add('hidden');
        returnDateField.querySelector('input').removeAttribute('required');

        // Update trip type
        tripTypeInput.value = 'one_way';
    }

    // Function to handle Round Trip selection
    function selectRoundTrip() {
        // Update button styles
        roundTripBtn.className = 'px-4 py-2 rounded-full text-sm font-medium transition duration-300';
        roundTripBtn.style.cssText = 'background: linear-gradient(135deg, rgba(255, 184, 148, 0.3) 0%, rgba(251, 149, 144, 0.3) 25%, rgba(220, 88, 109, 0.3) 50%, rgba(163, 55, 87, 0.3) 75%, rgba(76, 29, 61, 0.3) 100%); color: #4B5563;';
        oneWayBtn.className = 'text-gray-600 px-4 py-2 rounded-full text-sm hover:bg-gray-100 transition duration-300';
        oneWayBtn.style.cssText = '';

        // Show return date field
        returnDateField.classList.remove('hidden');
        returnDateField.querySelector('input').setAttribute('required', '');

        // Update trip type
        tripTypeInput.value = 'round_trip';
    }

    // Function to swap from and to destinations
    function swapDestinations() {
        const fromValue = fromSelect.value;
        const toValue = toSelect.value;

        fromSelect.value = toValue;
        toSelect.value = fromValue;
    }

    // Add event listeners
    oneWayBtn.addEventListener('click', selectOneWay);
    roundTripBtn.addEventListener('click', selectRoundTrip);
    swapBtn.addEventListener('click', swapDestinations);
    departureDateInput.addEventListener('change', updateReturnDateMin);

    // Initialize with One Way selected (return field hidden)
    selectOneWay();

    // Initialize return date minimum
    updateReturnDateMin();
</script>
@endpush
