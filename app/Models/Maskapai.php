<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maskapai extends Model
{
    protected $table = 'maskapai';
    protected $primaryKey = 'maskapai_id';
    public $timestamps = false;
    protected $fillable = ['nama_maskapai', 'kode_maskapai', 'logo'];
}
