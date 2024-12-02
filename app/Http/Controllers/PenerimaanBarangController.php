<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanBarangController extends Controller
{
    public function cariKode()
    {
        $data = DB::table('pemasoks')->get();
        return response()->json($data);
    }
    public function kodepro()
    {
        $data = DB::table('produks')->get();
        return response()->json($data);
    }
    public function save(Request $request)
    {
        $status = false;
        $no = "BM" . date("YmdHis");
        try {
            $item = $request->data1;
            foreach ($item as $itm) {
                $saveitem = [
                    [
                        'noterima' => $no,
                        'kodeproduk' => $itm['kodeproduk'],
                        'namaproduk' => $itm['namaproduk'],
                        'harga' => $itm['harga'],
                        'jumlah' => $itm['jumlah'],
                        'total' => $itm['total']
                    ],
                ];
                DB::table('penerimaanbarangdetails')->insert($saveitem);
            }
            foreach ($item as $t) {
                $simpanitem = [
                    [
                        'noterima' => $no,
                        'tglterima' => $t['tglterima'],
                        'referensi' => $t['referensi'],
                        'terimadari' => $t['terimadari'],
                        'keterangan' => $t['keterangan'],
                    ],
                ];
                DB::table('penerimaanbarangs')->insert($simpanitem);
            }
            $status = true;
            $data['message'] = 'Saved!';
            $response = [
                'status' => $status,
                'data' => $data
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $response = [
                'status' => $status,
                'data' => $data
            ];
            return response()->json($response);
        }
    }
    public function showpenerimaan()
    {
        $data = DB::table('penerimaanbarangdetails')->get();
        return response()->json($data);
    }
    public function showdatapemasok()
    {
        $data = DB::table('penerimaanbarangs')->get();
        return response()->json($data);
    }
    public function update(Request $request, $id)
    {
        $status = false;
        try{
            DB::table('penerimaanbarangdetails')->where('id', $id)->update([
                'kodeproduk' => $request->kodeproduk,
                'namaproduk' => $request->namaproduk,
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,
                'total' => $request->total
            ]);
            $status = true;
            $data['message'] = 'Saved!';
            $response = [
                'status' => $status,
                'data' => $data
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $response = [
                'status' => $status,
                'data' => $data
            ];
            return response()->json($response);
        }
    }
    public function updatepen(Request $request, $noterima)
    {
        $status = false;
        try{
            DB::table('penerimaanbarangs')->where('noterima', $noterima)->update([
                'tglterima' => $request->tanggal,
                'referensi' => $request->referensi,
                'terimadari' => $request->terimadari,
                'keterangan' => $request->keterangan
            ]);
            $status = true;
            $data['message'] = 'Saved!';
            $response = [
                'status' => $status,
                'data' => $data
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $response = [
                'status' => $status,
                'data' => $data
            ];
            return response()->json($response);
        }
    }
    public function loadprint()
    {
        $data = DB::table('penerimaanbarangs')->get();
        return response()->json($data);
    }
    public function cetak($id)
    {
        $k = $id;
        $selectbarangs = DB::select("SELECT * FROM `penerimaanbarangs` WHERE `penerimaanbarangs`.`noterima` = '$k'");
        $selectdetails = DB::select("SELECT * FROM `penerimaanbarangdetails` WHERE `penerimaanbarangdetails`.`noterima` = '$k'");

        foreach($selectbarangs as $b){
            $namapemasok = $b->terimadari;
        }
        $datapemasok = DB::select("SELECT * FROM `pemasoks` WHERE `pemasoks`.`namapemasok` = '$namapemasok'");
        return view('stok.cetakpenerimaanbarang', compact('selectbarangs','selectdetails', 'datapemasok'));
        // return $namapemasok;
    }
}
