<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $primaryKey = 'detail_id';
    public $timestamps = false;

    protected $fillable = ['pemesanan_id','penumpang_id'];

    public function penumpang()
    {
        return $this->belongsTo(Penumpang::class, 'penumpang_id');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }
}
