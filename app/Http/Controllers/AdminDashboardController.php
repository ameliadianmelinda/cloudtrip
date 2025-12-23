<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maskapai;
use App\Models\Bandara;
use App\Models\Pesawat;

class AdminDashboardController extends Controller
{
   public function index()
    {
        $totalMaskapai = Maskapai::count();
        $totalBandara = Bandara::count();
        $totalPesawat = Pesawat::count();

        return view('admin.dashboard', compact(
            'totalMaskapai',
            'totalBandara',
            'totalPesawat'
        ));
    } 
}