<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPenerbangan extends Model
{
    protected $table = 'jadwal_penerbangan';
    protected $primaryKey = 'jadwal_id';
    public $timestamps = false;

    protected $fillable = [
        'pesawat_id',
        'bandara_asal',
        'bandara_tujuan',
        'tanggal_berangkat',
        'waktu_berangkat',
        'waktu_tiba',
        'harga',
        'status',
    ];

    // Relationship ke Pesawat
    public function pesawat()
    {
        return $this->belongsTo(Pesawat::class, 'pesawat_id', 'pesawat_id');
    }

    // Relationship ke Bandara Asal
    public function bandaraAsal()
    {
        return $this->belongsTo(Bandara::class, 'bandara_asal', 'bandara_id');
    }

    // Relationship ke Bandara Tujuan
    public function bandaraTujuan()
    {
        return $this->belongsTo(Bandara::class, 'bandara_tujuan', 'bandara_id');
    }
}
