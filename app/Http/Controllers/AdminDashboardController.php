<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maskapai;
use App\Models\Bandara;
use App\Models\Pesawat;
use App\Models\Pemesanan;
use App\Models\Penumpang;
use App\Models\Pembayaran;

class AdminDashboardController extends Controller
{
   public function index()
    {
        // Get data counts
        $totalMaskapai = Maskapai::count();
        $totalBandara = Bandara::count();
        $totalPesawat = Pesawat::count();

        // Get booking and financial data
        $totalPemesanan = Pemesanan::count();
        $totalPenumpang = Penumpang::count();
        $totalJadwal = \App\Models\JadwalPenerbangan::count();
        $totalPendapatan = Pembayaran::where('status', 'success')->sum('jumlah');

        // Get booking status counts
        $pemesananPending = Pemesanan::where('status', 'pending')->count();
        $pemesananLunas = Pemesanan::where('status', 'paid')->count();
        $pemesananCancel = Pemesanan::where('status', 'cancel')->count();

        // Get payment status counts
        $pembayaranSuccess = Pembayaran::where('status', 'success')->count();
        $pembayaranPending = Pembayaran::where('status', 'pending')->count();
        $pembayaranFailed = Pembayaran::where('status', 'failed')->count();

        // Get recent bookings
        $recentPemesanan = Pemesanan::with(['jadwal.pesawat.maskapai', 'jadwal.bandaraAsal', 'jadwal.bandaraTujuan', 'detailPemesanan'])
            ->orderBy('tanggal_pesan', 'desc')
            ->take(5)
            ->get();

        return view('admin.Dashboard', compact(
            'totalMaskapai',
            'totalBandara',
            'totalPesawat',
            'totalPemesanan',
            'totalPenumpang',
            'totalJadwal',
            'totalPendapatan',
            'pemesananPending',
            'pemesananLunas',
            'pemesananCancel',
            'pembayaranSuccess',
            'pembayaranPending',
            'pembayaranFailed',
            'recentPemesanan'
        ));
    }
}
