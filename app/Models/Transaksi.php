<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //

    protected $table = 'transaksi';

    protected $fillable =[
        'no_struk',
        'meja_id',
        'nama_pelanggan',
        'order_id',
        'kasir_id',
        'nama_kasir',
        'total_bayar',
        'status_bayar',
        'waktu',
        'tanggal'
    ];

    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }
}
