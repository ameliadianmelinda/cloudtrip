<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use Illuminate\Http\Request;

class PenumpangController extends Controller
{
    public function index()
    {
        $penumpang = Penumpang::orderBy('penumpang_id', 'desc')->paginate(10);
        return view('admin.penumpang_index', compact('penumpang'));
    }
}
