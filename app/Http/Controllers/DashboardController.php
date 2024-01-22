<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model; //jika pakai eloquent
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Asset;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index(): View
    {
        //-----------query2 u/ data grafik-----------------
        $ar_gedung = Asset::where('kategori_id', 4)->count();
        $ar_elektronik = Asset::where('kategori_id', 5)->count();
        $ar_furniture = Asset::where('kategori_id', 6)->count();
        $total = Asset::where('kategori_id', 2)->sum('harga');
        $total2 = Asset::where('kategori_id', 1)->sum('harga');

        $grafik_bar = DB::table('asset')
        ->join('kategori', 'kategori.id', '=', 'asset.kategori_id')
        ->select('kategori.nama', DB::raw('COUNT(asset.kategori_id) AS jml'))
        ->groupBy('kategori.nama')
        ->get();

        $grafik_pie = DB::table('asset')
        ->join('kategori', 'kategori.id', '=', 'asset.kategori_id')
        ->select('kategori.nama', DB::raw('SUM(asset.harga) AS total_harga'))
        ->groupBy('kategori.nama')
        ->get();

        return view('backend.dashboard', 
            compact('ar_gedung','ar_elektronik','ar_furniture','total','total2',
                    'grafik_bar','grafik_pie')
        );
    }
}
