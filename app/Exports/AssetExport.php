<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class AssetExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Asset::all();
        $ar_asset = DB::table('asset as a')
            ->select('a.nama', 'k.nama as jenis', 'a.thn_beli', 'a.harga', 'a.masa_umur', 'a.kondisi')
            ->join('kategori as k', 'k.id', '=', 'a.kategori_id')
            ->get();
        
        return $ar_asset;
    }

    public function headings(): array
    {
        return ["Nama Asset", "Kategori", "Tahun Beli", "Harga",
                "Masa Umur","Kondisi"];
    }
}
