<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::orderBy('pembayaran_id', 'desc')->paginate(10);
        return view('admin.pembayaran_index', compact('pembayaran'));
    }
}
