<?php

namespace App\Exports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;


class MenuExport implements FromQuery, WithHeadings, WithStyles
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Menu::all();
    // }

    public function query()
    {
        return Menu::query()->select('id', 'nama_menu', 'deskripsi', 'harga', 'status_stok', 'penjualan', 'foto', 'kategori_id', 'created_at', 'updated_at')->latest();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Menu',
            'Deskripsi',
            'Harga',
            'Status Stok',
            'Penjualan',
            'Foto',
            'ID Kategori',
            'Tanggal Dibuat',
            'Tanggal Diubah'
        ];
    }

    // TAMBAHAN STYLING HEADER
    public function styles(Worksheet $sheet)
    {
        return [
            // ROW 1
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FF000000']
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['argb' => '065befff']
                ],
            ],
        ];
    }
}
