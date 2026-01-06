<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bandara;
use App\Models\JadwalPenerbangan;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'departure_date' => 'required|date',
            'return_date' => 'nullable|date|after:departure_date',
            'trip_type' => 'required|in:one_way,round_trip'
        ]);

        // Query untuk jadwal penerbangan berangkat
        $flights = DB::table('view_jadwal_lengkap')
            ->where('asal', $request->from)
            ->where('tujuan', $request->to)
            ->where('tanggal_berangkat', $request->departure_date)
            ->where('status', 'available')
            ->get();

        $returnFlights = null;
        if ($request->trip_type === 'round_trip' && $request->return_date) {
            // Query untuk jadwal penerbangan kembali
            $returnFlights = DB::table('view_jadwal_lengkap')
                ->where('asal', $request->to)
                ->where('tujuan', $request->from)
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
}
