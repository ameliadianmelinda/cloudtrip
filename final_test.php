<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== FINAL FLIGHT SEARCH TEST ===\n";

// Simulate the exact search that the controller would do
$from = 'Soekarno Hatta';
$to = 'Ngurah Rai';
$departure_date = date('Y-m-d', strtotime('+1 day')); // Tomorrow (same as form default)

echo "Searching flights:\n";
echo "From: {$from}\n";
echo "To: {$to}\n";
echo "Date: {$departure_date}\n\n";

// This is the exact query from the controller
$flights = DB::table('view_jadwal_lengkap')
    ->where('asal', $from)
    ->where('tujuan', $to)
    ->where('tanggal_berangkat', $departure_date)
    ->where('status', 'available')
    ->get();

echo "Results found: " . $flights->count() . "\n\n";

if ($flights->count() > 0) {
    echo "Flight details:\n";
    foreach ($flights as $flight) {
        echo "┌─────────────────────────────────────────────────────────────────\n";
        echo "│ {$flight->nama_maskapai} - {$flight->kode_pesawat}\n";
        echo "│ Route: {$flight->asal} → {$flight->tujuan}\n";
        echo "│ Date: {$flight->tanggal_berangkat}\n";
        echo "│ Time: {$flight->waktu_berangkat} - {$flight->waktu_tiba}\n";
        echo "│ Price: Rp " . number_format($flight->harga, 0, ',', '.') . "\n";
        echo "│ Status: {$flight->status}\n";
        echo "└─────────────────────────────────────────────────────────────────\n\n";
    }

    echo "✅ SEARCH IS NOW WORKING! ✅\n";
    echo "The search should return " . $flights->count() . " flight(s) when you test it in the browser.\n";
} else {
    echo "❌ Still no results found.\n";
}

// Also show what's available for debugging
echo "\n=== All flights available tomorrow ({$departure_date}) ===\n";
$tomorrowFlights = DB::table('view_jadwal_lengkap')
    ->where('tanggal_berangkat', $departure_date)
    ->get();

foreach ($tomorrowFlights as $flight) {
    echo "• {$flight->asal} → {$flight->tujuan} | {$flight->nama_maskapai} | {$flight->waktu_berangkat}\n";
}

?>
