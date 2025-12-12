<?php

namespace App\Http\Controllers;

use App\Models\Pesawat;
use App\Models\Maskapai;
use Illuminate\Http\Request;

class PesawatController extends Controller
{
    public function index()
    {
        $pesawat = Pesawat::with('maskapai')->get();
        return view('admin.pesawat', compact('pesawat'));
    }

    public function create()
    {
        $maskapai = Maskapai::all();
        return view('admin.pesawat_create', compact('maskapai'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_pesawat' => 'required|string',
            'tipe_pesawat' => 'required|string',
            'maskapai_id' => 'required|exists:maskapai,maskapai_id',
            'kapasitas' => 'required|integer',
        ]);

        Pesawat::create($validated);
        return redirect('/pesawat')->with('success', 'Pesawat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pesawat = Pesawat::findOrFail($id);
        $maskapai = Maskapai::all();
        return view('admin.pesawat_edit', compact('pesawat', 'maskapai'));
    }

    public function update(Request $request, $id)
    {
        $pesawat = Pesawat::findOrFail($id);
        
        $validated = $request->validate([
            'kode_pesawat' => 'required|string',
            'tipe_pesawat' => 'required|string',
            'maskapai_id' => 'required|exists:maskapai,maskapai_id',
            'kapasitas' => 'required|integer',
        ]);

        $pesawat->update($validated);
        return redirect('/pesawat')->with('success', 'Pesawat berhasil diubah');
    }

    public function destroy($id)
    {
        $pesawat = Pesawat::findOrFail($id);
        $pesawat->delete();
        return redirect('/pesawat')->with('success', 'Pesawat berhasil dihapus');
    }
}
