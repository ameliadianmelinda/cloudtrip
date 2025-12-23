<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesawat extends Model
{
    protected $table = 'pesawat';
    protected $primaryKey = 'pesawat_id';
    public $timestamps = false;
    protected $fillable = ['kode_pesawat', 'tipe_pesawat', 'maskapai_id', 'kapasitas'];

    public function maskapai()
    {
        return $this->belongsTo(Maskapai::class, 'maskapai_id', 'maskapai_id');
    }
}
