<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bandara;
use App\Models\JadwalPenerbangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomepageController extends Controller
{
    public function index()
    {
        // Ambil data bandara untuk dropdown
        $bandaras = Bandara::all();

        return view('customer.Homepage', compact('bandaras'));
    }

    public function searchFlights(Request $request)
    {
        // Debug: log the request data
        Log::info('Flight search request:', $request->all());

        $request->validate([
            'from' => 'required|different:to',
            'to' => 'required|different:from',
            'departure_date' => 'required|date|after_or_equal:today',
            'return_date' => 'nullable|date|after:departure_date',
            'trip_type' => 'required|in:one_way,round_trip'
        ], [
            'from.required' => 'Please select a departure city',
            'from.different' => 'Departure and destination cities must be different',
            'to.required' => 'Please select a destination city',
            'to.different' => 'Departure and destination cities must be different',
            'departure_date.required' => 'Please select a departure date',
            'departure_date.after_or_equal' => 'The departure date must be today or a future date',
            'return_date.after' => 'The return date field must be a date after departure date'
        ]);

        // Store trip type in session
        session(['trip_type' => $request->trip_type]);

        // Get Bandara IDs
        $bandaraAsal = Bandara::where('nama_bandara', $request->from)->first();
        $bandaraTujuan = Bandara::where('nama_bandara', $request->to)->first();

        if (!$bandaraAsal || !$bandaraTujuan) {
            return back()->withErrors(['error' => 'Invalid airport selection']);
        }

        // Query dengan Eloquent dan eager loading
        $flights = JadwalPenerbangan::with(['pesawat.maskapai', 'bandaraAsal', 'bandaraTujuan'])
            ->where('bandara_asal', $bandaraAsal->bandara_id)
            ->where('bandara_tujuan', $bandaraTujuan->bandara_id)
            ->where('tanggal_berangkat', $request->departure_date)
            ->where('status', 'available')
            ->get();

        $returnFlights = null;
        if ($request->trip_type === 'round_trip' && $request->return_date) {
            // Query untuk jadwal penerbangan kembali
            $returnFlights = JadwalPenerbangan::with(['pesawat.maskapai', 'bandaraAsal', 'bandaraTujuan'])
                ->where('bandara_asal', $bandaraTujuan->bandara_id)
                ->where('bandara_tujuan', $bandaraAsal->bandara_id)
                ->where('tanggal_berangkat', $request->return_date)
                ->where('status', 'available')
                ->get();
        }

        return view('customer.flight-results', [
            'flights' => $flights,
            'returnFlights' => $returnFlights,
            'searchData' => $request->all(),
            'tripType' => $request->trip_type
        ]);
    }

    public function flightDetail($id)
    {
        $flight = JadwalPenerbangan::with(['pesawat.maskapai', 'bandaraAsal', 'bandaraTujuan'])
            ->findOrFail($id);

        return view('customer.flight-detail', compact('flight'));
    }

    public function flightBooking($id)
    {
        $flight = JadwalPenerbangan::with(['pesawat.maskapai', 'bandaraAsal', 'bandaraTujuan'])
            ->findOrFail($id);

        return view('customer.flight-booking', compact('flight'));
    }
}
