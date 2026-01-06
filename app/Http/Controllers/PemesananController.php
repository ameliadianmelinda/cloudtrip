<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $pemesanan = Pemesanan::with(['user','jadwal.bandaraAsal','jadwal.bandaraTujuan','detailPemesanan','pembayaran'])
            ->orderBy('tanggal_pesan', 'desc')
            ->paginate(12);

        return view('admin.pemesanan_index', compact('pemesanan'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user','jadwal.pesawat.maskapai','jadwal.bandaraAsal','jadwal.bandaraTujuan','detailPemesanan.penumpang','pembayaran'])
            ->findOrFail($id);

        return view('admin.pemesanan_show', compact('pemesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,cancel',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status = $request->input('status');
        $pemesanan->save();

        return redirect()->back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }
}
