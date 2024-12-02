<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function getjumlahbrgb()
    {
        // b barang
        // m medis
        // pp paket promo
        // t treatment
        $brg = DB::table('produks')->where('kodegrup', '=', 'B')->count();
        return response()->json($brg);
    }
    public function getjumlahbrgm()
    {
        $brg = DB::table('produks')->where('kodegrup', '=', 'M')->count();
        return response()->json($brg);
    }
    public function getjumlahbrgpp()
    {
        $brg = DB::table('produks')->where('kodegrup', '=', 'PP')->count();
        return response()->json($brg);
    }
    public function getjumlahbrgt()
    {
        $brg = DB::table('produks')->where('kodegrup', '=', 'T')->count();
        return response()->json($brg);
    }
    public function getpenjualan1()
    {
        $penjualan = DB::table('penjualans')->whereMonth('tgljual', '1')->count();
        return response()->json($penjualan);
    }
    public function getpenjualan2()
    {
        $penjualan = DB::table('penjualans')->whereMonth('tgljual', '2')->count();
        return response()->json($penjualan);
    }
    public function getpenjualan3()
    {
        $penjualan = DB::table('penjualans')->whereMonth('tgljual', '3')->count();
        return response()->json($penjualan);
    }
    public function getpenjualan4()
    {
        $penjualan = DB::table('penjualans')->whereMonth('tgljual', '4')->count();
        return response()->json($penjualan);
    }
    public function getpenjualan5()
    {
        $penjualan = DB::table('penjualans')->whereMonth('tgljual', '5')->count();
        return response()->json($penjualan);
    }
}
