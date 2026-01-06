<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    protected $table = 'penumpang';
    protected $primaryKey = 'penumpang_id';
    public $timestamps = false;

    protected $fillable = ['nama_penumpang','nik','umur','jenis_kelamin'];
}
