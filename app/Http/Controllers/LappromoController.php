<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LappromoController extends Controller
{
    public function index()
    {
        $data = DB::select(
            "SELECT
            `produks`.`id`,
            `produks`.`kodeproduk`,
            `produks`.`namaproduk`,
            `produks`.`hargajual`,
            `produks`.`stokmin`,
            `penjualans`.`tgljual`,
            `penjualandetails`.`nofaktur`
            FROM
            `produks`,
            `penjualans`,
            `penjualandetails`
            WHERE
            `produks`.`kodegrup` = 'PP'"
        );
        return response()->json($data);
    }
    public function print()
    {
        $data = DB::select(
            "SELECT
            `produks`.`id`,
            `produks`.`kodeproduk`,
            `produks`.`namaproduk`,
            `produks`.`hargajual`,
            `produks`.`stokmin`,
            `penjualans`.`tgljual`,
            `penjualandetails`.`nofaktur`
            FROM
            `produks`,
            `penjualans`,
            `penjualandetails`
            WHERE
            `produks`.`kodegrup` = 'PP'"
        );
        return view('laporan.printpromo', compact('data'));
    }
    public function excel()
    {
        $data = DB::select(
            "SELECT
            `produks`.`id`,
            `produks`.`kodeproduk`,
            `produks`.`namaproduk`,
            `produks`.`hargajual`,
            `produks`.`stokmin`,
            `penjualans`.`tgljual`,
            `penjualandetails`.`nofaktur`
            FROM
            `produks`,
            `penjualans`,
            `penjualandetails`
            WHERE
            `produks`.`kodegrup` = 'PP'"
        );
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=LAPORAN_PENJUALAN_PROMO.xls");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        return view('laporan.excelpromo', compact('data'));
    }
    public function pdf()
    {
        $paket = DB::select(
            "SELECT
            `produks`.`id`,
            `produks`.`kodeproduk`,
            `produks`.`namaproduk`,
            `produks`.`hargajual`,
            `produks`.`stokmin`,
            `penjualans`.`tgljual`,
            `penjualandetails`.`nofaktur`
            FROM
            `produks`,
            `penjualans`,
            `penjualandetails`
            WHERE
            `produks`.`kodegrup` = 'PP'"
        );
        $pdf = PDF::loadView("laporan/pdfpromo", ['paket' => $paket]);
        return $pdf->download('DATA_PAKET_PROMO.pdf');
    }
}
