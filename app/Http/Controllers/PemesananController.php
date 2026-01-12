<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PemesananController extends Controller
{
    public function store(Request $request)
    {
        // Debug: Log incoming request
        Log::info('Booking store - Incoming data: ', $request->all());

        // Validasi input
        $validated = $request->validate([
            'flight_id' => 'required|exists:jadwal_penerbangan,jadwal_id',
            'total_passengers' => 'required|integer|min:1',
            'nama_penumpang' => 'required|array',
            'nama_penumpang.*' => 'required|string|max:255',
            'nik' => 'required|array',
            'nik.*' => 'required|string|size:16',
            'birth_day' => 'required|array',
            'birth_day.*' => 'required|numeric',
            'birth_month' => 'required|array',
            'birth_month.*' => 'required|numeric',
            'birth_year' => 'required|array',
            'birth_year.*' => 'required|numeric',
            'jenis_kelamin' => 'required|array',
            'jenis_kelamin.*' => 'required|in:L,P',
        ]);

        Log::info('Booking store - Validation passed: ', $validated);

        try {
            // Get flight data to get the price
            $jadwal = \App\Models\JadwalPenerbangan::findOrFail($validated['flight_id']);

            // Calculate total price
            $totalHarga = $jadwal->harga * $validated['total_passengers'];

            // Generate booking code: CT-XXXXX (5 random digits)
            $kodePemesanan = 'CT-' . rand(10000, 99999);

            // Buat pemesanan baru dengan status pending
            $pemesanan = Pemesanan::create([
                'user_id' => Auth::id(),
                'jadwal_id' => $validated['flight_id'],
                'kode_pemesanan' => $kodePemesanan,
                'total_harga' => $totalHarga,
                'status' => 'pending',
                'tanggal_pesan' => now(),
            ]);

            Log::info('Pemesanan created: ', ['pemesanan_id' => $pemesanan->pemesanan_id, 'kode_pemesanan' => $kodePemesanan, 'total_harga' => $totalHarga]);

            // Loop untuk setiap penumpang
            for ($i = 0; $i < $validated['total_passengers']; $i++) {
                // Buat detail penumpang
                $detailPemesanan = $pemesanan->detailPemesanan()->create([]);

                Log::info('Detail Pemesanan created: ', ['detail_pemesanan_id' => $detailPemesanan->id, 'penumpang_ke' => $i + 1]);

                // Hitung umur dari tanggal lahir
                $tanggal_lahir = $validated['birth_year'][$i] . '-' . str_pad($validated['birth_month'][$i], 2, '0', STR_PAD_LEFT) . '-' . str_pad($validated['birth_day'][$i], 2, '0', STR_PAD_LEFT);
                $umur = \Carbon\Carbon::parse($tanggal_lahir)->age;

                // Buat penumpang
                $detailPemesanan->penumpang()->create([
                    'nama_penumpang' => $validated['nama_penumpang'][$i],
                    'nik' => $validated['nik'][$i],
                    'umur' => $umur,
                    'jenis_kelamin' => $validated['jenis_kelamin'][$i],
                ]);

                Log::info('Penumpang created successfully', ['penumpang_ke' => $i + 1, 'umur' => $umur]);
            }

            return redirect()->route('payment.show', $pemesanan->pemesanan_id)
                ->with('success', 'Pemesanan berhasil dibuat. Silakan lanjutkan pembayaran.');
        } catch (\Exception $e) {
            Log::error('Booking error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat pemesanan: ' . $e->getMessage());
        }
    }

    public function payment($pemesanan)
    {
        $pemesanan = Pemesanan::with([
            'jadwal.bandaraAsal',
            'jadwal.bandaraTujuan',
            'jadwal.pesawat.maskapai',
            'detailPemesanan.penumpang'
        ])->findOrFail($pemesanan);

        // Pastikan user hanya bisa akses pemesanannya sendiri
        if ($pemesanan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('customer.payment', compact('pemesanan'));
    }

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

    public function storePayment(Request $request)
    {
        try {
            $validated = $request->validate([
                'pemesanan_id' => 'required|exists:pemesanan,pemesanan_id',
                'metode' => 'required|in:transfer,qris,va',
                'jumlah' => 'required|numeric|min:0',
                'status' => 'required|in:success,failed,pending',
                'bank' => 'nullable|string'
            ]);

            // Normalisasi metode ke enum tabel pembayaran
            $metode = in_array($validated['metode'], ['transfer', 'qris', 'va'])
                ? $validated['metode']
                : 'va';

            // Update status pemesanan dari pending ke paid
            $pemesanan = Pemesanan::findOrFail($validated['pemesanan_id']);
            $pemesanan->status = 'paid';
            $pemesanan->save();

            // Simpan data pembayaran
            $pembayaran = $pemesanan->pembayaran()->create([
                'metode' => $metode,
                'jumlah' => $validated['jumlah'],
                'status' => $validated['status'],
                'tanggal_bayar' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran & transaksi berhasil disimpan',
                'data' => [
                    'pembayaran' => $pembayaran,
                    'transaksi' => $transaksi
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Payment store error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
