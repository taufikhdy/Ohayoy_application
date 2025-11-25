<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use App\Exports\MenuTerlarisExport;
use App\Exports\MenuExport;
use App\Models\Transaksi;

class ExportController extends Controller
{
    //

    // EXPORT TRANSAKSI FILTER TANGGAL
    public function exportTransaksi(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date'
        ]);


        return Excel::download(
            new TransaksiExport($request->from, $request->to),
            'Ohayoy Laporan Transaksi.xlsx'
        );
    }

    public function exportMenu()
    {
        return Excel::download(
            new MenuExport(),
            'Ohayoy Data Menu.xlsx'
        );
    }

    public function exportMenuTerlaris()
    {
        return Excel::download(
            new MenuTerlarisExport(),
            'Ohayoy Laporan Menu Terlaris.xlsx'
        );
    }
}
