<?php

namespace App\Http\Controllers;

use App\Models\JadwalPenerbangan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPenerbangan::with(['pesawat.maskapai', 'bandaraAsal', 'bandaraTujuan'])->get();

        $summary = [
            'total' => $jadwals->count(),
            'available' => $jadwals->where('status', 'available')->count(),
            'delay' => $jadwals->where('status', 'delay')->count(),
            'cancel' => $jadwals->where('status', 'cancel')->count(),
        ];

        $pemesanan = Pemesanan::with(['user','jadwal.bandaraAsal','jadwal.bandaraTujuan'])->orderBy('tanggal_pesan', 'desc')->get();

        $transSummary = [
            'total_transactions' => $pemesanan->count(),
            'total_revenue' => $pemesanan->sum('total_harga'),
        ];

        return view('admin.laporan', compact('jadwals', 'summary', 'pemesanan', 'transSummary'));
    }

    public function print()
    {
        $pemesanan = Pemesanan::with(['user','jadwal.bandaraAsal','jadwal.bandaraTujuan'])->orderBy('tanggal_pesan','desc')->get();
        $total_revenue = $pemesanan->sum('total_harga');
        return view('admin.laporan_print', compact('pemesanan', 'total_revenue'));
    }
}
