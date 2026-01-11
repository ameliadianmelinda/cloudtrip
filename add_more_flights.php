<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== ADDING MORE FLIGHT DATA ===\n";

$tomorrow = date('Y-m-d', strtotime('+1 day'));
$dayAfter = date('Y-m-d', strtotime('+2 days'));
$dayAfter2 = date('Y-m-d', strtotime('+3 days'));

// Add more flights for better testing
$newFlights = [
    // More flights for tomorrow
    [
        'pesawat_id' => 2, // Assuming Lion Air
        'bandara_asal' => 1, // Soekarno Hatta
        'bandara_tujuan' => 2, // Ngurah Rai
        'tanggal_berangkat' => $tomorrow,
        'waktu_berangkat' => '14:00:00',
        'waktu_tiba' => '16:00:00',
        'harga' => 1500000.00,
        'status' => 'available'
    ],
    [
        'pesawat_id' => 3, // Assuming Citilink
        'bandara_asal' => 1, // Soekarno Hatta
        'bandara_tujuan' => 2, // Ngurah Rai
        'tanggal_berangkat' => $tomorrow,
        'waktu_berangkat' => '18:00:00',
        'waktu_tiba' => '20:00:00',
        'harga' => 1800000.00,
        'status' => 'available'
    ],
    // Return flights
    [
        'pesawat_id' => 1, // Garuda
        'bandara_asal' => 2, // Ngurah Rai
        'bandara_tujuan' => 1, // Soekarno Hatta
        'tanggal_berangkat' => $dayAfter,
        'waktu_berangkat' => '09:00:00',
        'waktu_tiba' => '11:00:00',
        'harga' => 2100000.00,
        'status' => 'available'
    ],
    [
        'pesawat_id' => 2, // Lion Air
        'bandara_asal' => 2, // Ngurah Rai
        'bandara_tujuan' => 1, // Soekarno Hatta
        'tanggal_berangkat' => $dayAfter,
        'waktu_berangkat' => '15:00:00',
        'waktu_tiba' => '17:00:00',
        'harga' => 1600000.00,
        'status' => 'available'
    ]
];

foreach ($newFlights as $flight) {
    DB::table('jadwal_penerbangan')->insert($flight);
    echo "Added flight: " . DB::getPdo()->lastInsertId() . "\n";
}

echo "Additional flights added successfully!\n";

// Verify all flights
echo "\n=== All available flights ===\n";
$allFlights = DB::table('view_jadwal_lengkap')->orderBy('tanggal_berangkat')->orderBy('waktu_berangkat')->get();
foreach ($allFlights as $flight) {
    echo "- {$flight->nama_maskapai}: {$flight->asal} -> {$flight->tujuan} on {$flight->tanggal_berangkat} at {$flight->waktu_berangkat} (Rp " . number_format($flight->harga, 0, ',', '.') . ")\n";
}

?>
