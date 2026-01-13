<?php

namespace App\Http\Controllers;

use App\Models\JadwalPenerbangan;
use App\Models\Pesawat;
use App\Models\Bandara;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class JadwalPenerbanganController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPenerbangan::with(['pesawat', 'bandaraAsal', 'bandaraTujuan'])->get();

        $summary = [
            'total' => $jadwal->count(),
            'available' => $jadwal->where('status', 'available')->count(),
            'delay' => $jadwal->where('status', 'delay')->count(),
            'cancel' => $jadwal->where('status', 'cancel')->count(),
        ];

        return view('admin.jadwal_penerbangan', compact('jadwal', 'summary'));
    }
    
    public function create()
    {
        $pesawat = Pesawat::all();
        $bandara = Bandara::all();
        return view('admin.jadwal_penerbangan_create', compact('pesawat', 'bandara'));
    }

    public function store(Request $request)
    {
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

        // Defensive check and graceful error handling for FK constraints
        if (!Pesawat::where('pesawat_id', $validated['pesawat_id'])->exists()) {
            return redirect()->back()->withInput()->withErrors(['pesawat_id' => 'Pesawat tidak ditemukan.']);
        }

        try {
            JadwalPenerbangan::create($validated);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['general' => 'Terjadi kesalahan saat menyimpan jadwal. Periksa data dan coba lagi.']);
        }

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

        if (!Pesawat::where('pesawat_id', $validated['pesawat_id'])->exists()) {
            return redirect()->back()->withInput()->withErrors(['pesawat_id' => 'Pesawat tidak ditemukan.']);
        }

        try {
            $jadwal->update($validated);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['general' => 'Terjadi kesalahan saat memperbarui jadwal.']);
        }

        return redirect()->route('jadwal_penerbangan')->with('success', 'Jadwal penerbangan berhasil diubah');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPenerbangan::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal_penerbangan')->with('success', 'Jadwal penerbangan berhasil dihapus');
    }
}