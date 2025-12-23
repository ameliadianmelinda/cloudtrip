<?php

namespace App\Http\Controllers;

use App\Models\Maskapai;
use Illuminate\Http\Request;

class MaskapaiController extends Controller
{
    public function index()
    {
        $maskapai = Maskapai::all();
        return view('admin.maskapai', compact('maskapai'));
    }
    
    public function create()
    {
        return view('admin.maskapai_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_maskapai' => 'required|string',
            'kode_maskapai' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time().'_'.preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('images'), $filename);
            $validated['logo'] = 'images/'.$filename;
        }

        Maskapai::create($validated);
        return redirect()->route('maskapai')->with('success', 'Maskapai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $maskapai = Maskapai::findOrFail($id);
        return view('admin.maskapai_edit', compact('maskapai'));
    }

    public function update(Request $request, $id)
    {
        $maskapai = Maskapai::findOrFail($id);
        $validated = $request->validate([
            'nama_maskapai' => 'required|string',
            'kode_maskapai' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // remove old logo if exists
            if ($maskapai->logo && file_exists(public_path($maskapai->logo))) {
                @unlink(public_path($maskapai->logo));
            }
            $file = $request->file('logo');
            $filename = time().'_'.preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('images'), $filename);
            $validated['logo'] = 'images/'.$filename;
        }

        $maskapai->update($validated);
        return redirect()->route('maskapai')->with('success', 'Maskapai berhasil diubah');
    }

    public function destroy($id)
    {
        $maskapai = Maskapai::findOrFail($id);
        if ($maskapai->logo && file_exists(public_path($maskapai->logo))) {
            @unlink(public_path($maskapai->logo));
        }
        $maskapai->delete();
        return redirect()->route('maskapai')->with('success', 'Maskapai berhasil dihapus');
    }
}
