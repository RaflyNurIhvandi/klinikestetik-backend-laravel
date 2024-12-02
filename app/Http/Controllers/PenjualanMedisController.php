<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PenjualanMedisController extends Controller
{
    public function index()
    {
        // $data = DB::table('produks')->where('')->get();
        $data = DB::select("SELECT produks.id,produks.namaproduk,produks.hargajual,penjualandetails.nofaktur,penjualans.tgljual
                            FROM produks,penjualandetails,penjualans,grups
                            WHERE produks.kodegrup='M'");
        return response()->json($data);
    }
    public function print()
    {
        $data = DB::select("SELECT produks.id,produks.namaproduk,produks.hargajual,penjualandetails.nofaktur,penjualans.tgljual
                            FROM produks,penjualandetails,penjualans,grups
                            WHERE produks.kodegrup='M'");
        return view('laporan.print', compact('data'));
    }

    public function excel()
    {
        $data = DB::select("SELECT produks.id,produks.namaproduk,produks.hargajual,penjualandetails.nofaktur,penjualans.tgljual
                            FROM produks,penjualandetails,penjualans,grups
                            WHERE produks.kodegrup='M'");
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=DATA_PENJUALAN_MEDIS.xls");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        return view('laporan.excel', compact('data'));
    }
    public function pdf()
    {
        $data = DB::select("SELECT produks.id,produks.namaproduk,produks.hargajual,penjualandetails.nofaktur,penjualans.tgljual
                            FROM produks,penjualandetails,penjualans,grups
                            WHERE produks.kodegrup='M'");
        $pdf = PDF::loadview('laporan.pdf', compact('data'));
        return $pdf->download('Penjualan_Medis.pdf');
    }
}
