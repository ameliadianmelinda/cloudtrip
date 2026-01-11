<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== DEBUG FLIGHT SEARCH ===\n";

// Check if view exists and has data
try {
    $viewData = DB::table('view_jadwal_lengkap')->get();
    echo "View 'view_jadwal_lengkap' data count: " . $viewData->count() . "\n";

    if ($viewData->count() > 0) {
        echo "Sample data from view:\n";
        print_r($viewData->first());

        echo "\nAll available routes:\n";
        foreach ($viewData as $flight) {
            echo "Route: {$flight->asal} -> {$flight->tujuan} | Date: {$flight->tanggal_berangkat} | Status: {$flight->status}\n";
        }
    }

} catch (Exception $e) {
    echo "Error accessing view: " . $e->getMessage() . "\n";
}

// Check individual tables
echo "\n=== TABLE DATA ===\n";
echo "Bandara count: " . DB::table('bandara')->count() . "\n";
echo "Maskapai count: " . DB::table('maskapai')->count() . "\n";
echo "Pesawat count: " . DB::table('pesawat')->count() . "\n";
echo "JadwalPenerbangan count: " . DB::table('jadwal_penerbangan')->count() . "\n";

// Show some sample data
$bandaras = DB::table('bandara')->get();
echo "\nBandara data:\n";
foreach ($bandaras as $bandara) {
    echo "ID: {$bandara->bandara_id}, Name: {$bandara->nama_bandara}\n";
}

$jadwals = DB::table('jadwal_penerbangan')->get();
echo "\nJadwal Penerbangan data:\n";
foreach ($jadwals as $jadwal) {
    echo "ID: {$jadwal->jadwal_id}, From: {$jadwal->bandara_asal}, To: {$jadwal->bandara_tujuan}, Date: {$jadwal->tanggal_berangkat}, Status: {$jadwal->status}\n";
}

?>
