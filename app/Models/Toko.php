<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    //
    protected $table = 'toko';

    protected $fillable = [
        'nama_toko',
        'tagline_toko',
        'alamat_toko',
        'website_toko',
        'ucapan'
    ];
}
