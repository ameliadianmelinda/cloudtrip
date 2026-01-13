<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== UPDATING FLIGHT DATA FOR CURRENT DATES ===\n";

// Update existing flights to use dates starting from tomorrow
$tomorrow = date('Y-m-d', strtotime('+1 day'));
$dayAfter = date('Y-m-d', strtotime('+2 days'));
$dayAfter2 = date('Y-m-d', strtotime('+3 days'));

echo "Updating flight dates to: {$tomorrow}, {$dayAfter}, {$dayAfter2}\n";

// Update the three existing flights
DB::table('jadwal_penerbangan')->where('jadwal_id', 1)->update(['tanggal_berangkat' => $tomorrow]);
DB::table('jadwal_penerbangan')->where('jadwal_id', 2)->update(['tanggal_berangkat' => $dayAfter]);
DB::table('jadwal_penerbangan')->where('jadwal_id', 3)->update(['tanggal_berangkat' => $dayAfter2]);

echo "Flight dates updated successfully!\n";

// Verify the update
echo "\nVerifying updates:\n";
$flights = DB::table('view_jadwal_lengkap')->get();
foreach ($flights as $flight) {
    echo "Flight {$flight->jadwal_id}: {$flight->asal} -> {$flight->tujuan} on {$flight->tanggal_berangkat}\n";
}

// Test search again
echo "\n=== Testing search with tomorrow's date ===\n";
$testFlights = DB::table('view_jadwal_lengkap')
    ->where('asal', 'Soekarno Hatta')
    ->where('tujuan', 'Ngurah Rai')
    ->where('tanggal_berangkat', $tomorrow)
    ->where('status', 'available')
    ->get();

echo "Flights found: " . $testFlights->count() . "\n";

?>
