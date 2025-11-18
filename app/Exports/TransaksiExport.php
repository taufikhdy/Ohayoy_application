<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Transaksi::all();
        // PILIH KOLOM YANG MAU DI EXPORT AGAR RAPI
        // return Transaksi::select('id','no_struk', 'meja_id', 'nama_pelanggan', 'kasir_id', 'total_bayar', 'tanggal' ,'waktu')->get();
        $data = Transaksi::with('kasir')->get();

        $result = [];

        foreach($data as $d){
            $result[] = [
                'id' => $d->id,
                'no_struk' => $d->no_struk,
                'meja_id' => $d->meja_id,
                'nama_pelanggan' => $d->nama_pelanggan,
                'kasir_id' => $d->kasir_id,
                'kasir' => $d->nama_kasir,
                'total_bayar' => $d->total_bayar,
                'tanggal' => $d->tanggal,
                'waktu' => $d->waktu
            ];
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nomor Struk',
            'ID Meja',
            'Nama Pelanggan',
            'ID Kasir',
            'Kasir',
            'Total Bayar',
            'Tanggal',
            'Waktu'
        ];
    }
}
