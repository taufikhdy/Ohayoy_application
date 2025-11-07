<?php

namespace Database\Seeders;

use App\Models\Toko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Toko::create([
            'nama_toko' => 'Ohayoy',
            'tagline_toko' => 'Jangan Lupa Makan, Tetep exiss',
            'alamat_toko' => 'Jalan Raya Bandung, Km.03',
            'website_toko' => 'https://Ohayoy.com',
            'ucapan' => 'Terimakasih Telah Makan di Toko Kami ❤️'
        ]);
    }
}
