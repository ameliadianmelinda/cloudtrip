<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== FLIGHT SEARCH TEST ===\n";

// Test search with actual data
$testFrom = 'Soekarno Hatta';
$testTo = 'Ngurah Rai';
$testDate = '2026-02-01'; // This is the date in our dummy data

echo "Testing search: From: {$testFrom}, To: {$testTo}, Date: {$testDate}\n\n";

$flights = DB::table('view_jadwal_lengkap')
    ->where('asal', $testFrom)
    ->where('tujuan', $testTo)
    ->where('tanggal_berangkat', $testDate)
    ->where('status', 'available')
    ->get();

echo "Query result count: " . $flights->count() . "\n";

if ($flights->count() > 0) {
    echo "Found flights:\n";
    foreach ($flights as $flight) {
        echo "- {$flight->nama_maskapai} {$flight->kode_pesawat}\n";
        echo "  Route: {$flight->asal} -> {$flight->tujuan}\n";
        echo "  Date: {$flight->tanggal_berangkat}\n";
        echo "  Time: {$flight->waktu_berangkat} - {$flight->waktu_tiba}\n";
        echo "  Price: Rp " . number_format($flight->harga, 0, ',', '.') . "\n";
        echo "  Status: {$flight->status}\n\n";
    }
} else {
    echo "No flights found!\n";

    echo "\nDebugging...\n";
    echo "Available routes for date {$testDate}:\n";
    $availableFlights = DB::table('view_jadwal_lengkap')
        ->where('tanggal_berangkat', $testDate)
        ->get();

    foreach ($availableFlights as $flight) {
        echo "- {$flight->asal} -> {$flight->tujuan} on {$flight->tanggal_berangkat}\n";
    }
}

// Test with tomorrow's date (current form default)
$tomorrow = date('Y-m-d', strtotime('+1 day'));
echo "\n=== Testing with tomorrow's date: {$tomorrow} ===\n";

$tomorrowFlights = DB::table('view_jadwal_lengkap')
    ->where('asal', $testFrom)
    ->where('tujuan', $testTo)
    ->where('tanggal_berangkat', $tomorrow)
    ->where('status', 'available')
    ->get();

echo "Flights found for tomorrow: " . $tomorrowFlights->count() . "\n";

?>
