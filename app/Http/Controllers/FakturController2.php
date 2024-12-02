<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FakturController extends Controller
{
    public $data = [];
    public function getpelanggan()
    {
        $pelanggan = DB::table('pelanggans')->get();

        $hsl = [
            'success' => true,
            'message' => 'Customer',
            'data' => $pelanggan,
        ];

        return response()->json($hsl);
    }
    public function getnamapelanggan($id)
    {
        $pelanggan = DB::table('pelanggans')->where('kodepelanggan', $id)->get();
        $hsl = [
            'success' => true,
            'message' => 'Customer',
            'data' => $pelanggan,
        ];

        return response()->json($hsl);
    }
    public function getkodebarang($id)
    {
        $barang = DB::table('produks')->where('kodeproduk', $id)->get();
        $hsl = [
            'success' => true,
            'message' => 'Customer',
            'data' => $barang,
        ];

        return response()->json($hsl);
    }
    public function getnofaktur()
    {
        $carbon = Carbon::now();
        $getyear = $carbon->now()->format('Y');
        $getmonth = $carbon->now()->format('m');
        $getday = $carbon->format('d');
        $gethours = $carbon->now()->format('H');
        $getminute = $carbon->now()->minute;
        $getsecond = $carbon->now()->second;

        $getfaktur = $getyear . $getmonth . $getday . $gethours . $getminute . $getsecond;

        return response()->json($getfaktur);
    }
    public function getdate()
    {
        $carbon = Carbon::now();
        $get = $carbon->now()->format('Y-m-d');

        return response()->json($get);
    }
    public function insertitem(Request $request)
    {
        // return $request->data2;
        DB::beginTransaction();
        try {
            DB::table('penjualans')
            // ->join('penjualandetails', )
                ->insert([
                    'nofaktur' => $request->data2['nofaktur'],
                    'tgljual' => $request->data2['tgljual'],
                    'kodepelanggan' => $request->data2['kodepelanggan'],
                    // 'statusbayar'=>$itm2->statusbayar,
                    'syaratbayar' => $request->data2['syaratbayar'],
                    'tgljatuhtempo' => $request->data2['tgljatuhtempo'],
                    'keteranganbayar' => $request->data2['keteranganbayar'],
                    'diskon' => $request->data2['diskon'],
                    'voucher' => $request->data2['voucher'],
                    'total' => $request->data2['total'],
                    'totalpajak' => $request->data2['totalpajak'],
                    'grandtotal' => $request->data2['grandtotal'],
                    'bayar' => $request->data2['bayar'],
                    'kembali' => $request->data2['kembali'],
                    'keterangan' => $request->data2['keterangan'],
                    // 'kode_pegawai'=>$request->data2['m2']->kode_pegawai,
                ]);
            $itm1 = $request->data1;
            foreach ($itm1 as $brg) {
                $simpanitem = [
                    [
                        'nofaktur' => $brg['nofaktur'],
                        'kodeproduk' => $brg['kodeproduk'],
                        // 'namaproduk' => $brg['namaproduk'],
                        'harga' => $brg['hargajual'],
                        'jumlah' => $brg['jumlah'],
                        'diskon' => $brg['diskon'],
                    ],
                ];
                DB::table('penjualandetails')
                    ->insert($simpanitem);
            }
        } catch (\Exception$e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Rekam medik tidak dapat disimpan',
            ];
        }
        return response()->json($hasil);
    }
    public function cetak($id)
    {
        // return $id;
        $cetak = DB::table('pelanggans')
            ->join('penjualans', 'pelanggans.kodepelanggan', '=', 'penjualans.kodepelanggan')
            ->where('nofaktur', $id)
            ->get();

        $cetak2 = DB::table('penjualandetails')
            ->join('produks', 'penjualandetails.kodeproduk', '=', 'produks.kodeproduk')
            ->where('nofaktur', $id)
            ->get();

        // $pdf = PDF::loadview('faktur.cetak', ['$cetak' => $cetak])->setPaper('A4', 'potrait');
        // return $pdf->stream("$id.pdf");
        return view('faktur/cetak', compact("cetak", "cetak2"));
        // return response()->json($cetak);

    }

}
