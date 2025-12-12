<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bandara extends Model
{
    protected $table = 'bandara';
    protected $primaryKey = 'bandara_id';
    public $timestamps = false;

    protected $fillable = [
        'kode_bandara',
        'nama_bandara',
        'kota',
        'negara',
    ];
}
