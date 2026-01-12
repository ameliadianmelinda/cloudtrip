<?php

namespace App\Http\Controllers;

use App\Models\JadwalPenerbangan;
use App\Models\Pesawat;
use App\Models\Bandara;
use Illuminate\Http\Request;

class JadwalPenerbanganController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPenerbangan::with(['pesawat', 'bandaraAsal', 'bandaraTujuan'])->get();
        return view('admin.jadwal_penerbangan', compact('jadwal'));
    }
    
    public function create()
    {
        $pesawat = Pesawat::all();
        $bandara = Bandara::all();
        return view('admin.jadwal_penerbangan_create', compact('pesawat', 'bandara'));
    }

    public function store(Request $request)
    {
        // Normalisasi format waktu jika user mengirimkan format 12-jam (contoh: "03:05 AM")
        if ($request->filled('waktu_berangkat')) {
            try {
                $t = \Carbon\Carbon::createFromFormat('h:i A', $request->input('waktu_berangkat'));
                $request->merge(['waktu_berangkat' => $t->format('H:i')]);
            } catch (\Exception $e) {
                // jika gagal, biarkan Laravel validasi menangani nilai apa adanya
            }
        }
        if ($request->filled('waktu_tiba')) {
            try {
                $t2 = \Carbon\Carbon::createFromFormat('h:i A', $request->input('waktu_tiba'));
                $request->merge(['waktu_tiba' => $t2->format('H:i')]);
            } catch (\Exception $e) {
            }
        }

        $validated = $request->validate([
            'pesawat_id' => 'required|integer|exists:pesawat,pesawat_id',
            'bandara_asal' => 'required|integer|exists:bandara,bandara_id',
            'bandara_tujuan' => 'required|integer|exists:bandara,bandara_id|different:bandara_asal',
            'tanggal_berangkat' => 'required|date',
            'waktu_berangkat' => 'required|date_format:H:i',
            'waktu_tiba' => 'required|date_format:H:i',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:available,cancel,delay',
        ]);

        JadwalPenerbangan::create($validated);
        return redirect()->route('jadwal_penerbangan')->with('success', 'Jadwal penerbangan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = JadwalPenerbangan::findOrFail($id);
        $pesawat = Pesawat::all();
        $bandara = Bandara::all();
        return view('admin.jadwal_penerbangan_edit', compact('jadwal', 'pesawat', 'bandara'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPenerbangan::findOrFail($id);
        // Normalisasi input waktu 12-jam -> 24-jam sebelum validasi
        if ($request->filled('waktu_berangkat')) {
            try {
                $t = \Carbon\Carbon::createFromFormat('h:i A', $request->input('waktu_berangkat'));
                $request->merge(['waktu_berangkat' => $t->format('H:i')]);
            } catch (\Exception $e) {
            }
        }
        if ($request->filled('waktu_tiba')) {
            try {
                $t2 = \Carbon\Carbon::createFromFormat('h:i A', $request->input('waktu_tiba'));
                $request->merge(['waktu_tiba' => $t2->format('H:i')]);
            } catch (\Exception $e) {
            }
        }
        $validated = $request->validate([
            'pesawat_id' => 'required|integer|exists:pesawat,pesawat_id',
            'bandara_asal' => 'required|integer|exists:bandara,bandara_id',
            'bandara_tujuan' => 'required|integer|exists:bandara,bandara_id|different:bandara_asal',
            'tanggal_berangkat' => 'required|date',
            'waktu_berangkat' => 'required|date_format:H:i',
            'waktu_tiba' => 'required|date_format:H:i',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:available,cancel,delay',
        ]);

        $jadwal->update($validated);
        return redirect()->route('jadwal_penerbangan')->with('success', 'Jadwal penerbangan berhasil diubah');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPenerbangan::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal_penerbangan')->with('success', 'Jadwal penerbangan berhasil dihapus');
    }
}