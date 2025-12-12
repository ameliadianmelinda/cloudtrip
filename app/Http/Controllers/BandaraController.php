<?php

namespace App\Http\Controllers;

use App\Models\Bandara;
use Illuminate\Http\Request;

class BandaraController extends Controller
{
    public function index()
    {
        $bandara = Bandara::all();
        return view('admin.bandara', compact('bandara'));
    }

    public function create()
    {
        return view('admin.bandara_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_bandara' => 'required|string',
            'nama_bandara' => 'required|string',
            'kota' => 'required|string',
            'negara' => 'required|string',
        ]);

        Bandara::create($validated);
        return redirect('/bandara')->with('success', 'Bandara berhasil ditambahkan');
    }

    public function edit($id)
    {
        $bandara = Bandara::findOrFail($id);
        return view('admin.bandara_edit', compact('bandara'));
    }

    public function update(Request $request, $id)
    {
        $bandara = Bandara::findOrFail($id);
        
        $validated = $request->validate([
            'kode_bandara' => 'required|string',
            'nama_bandara' => 'required|string',
            'kota' => 'required|string',
            'negara' => 'required|string',
        ]);

        $bandara->update($validated);
        return redirect('/bandara')->with('success', 'Bandara berhasil diperbarui');
    }

    public function destroy($id)
    {
        $bandara = Bandara::findOrFail($id);
        $bandara->delete();
        return redirect('/bandara')->with('success', 'Bandara berhasil dihapus');
    }
}
