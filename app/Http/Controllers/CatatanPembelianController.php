<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatatanPembelianController extends Controller
{
    public function loadpemasok()
    {
        $data = DB::table('pemasoks')->get();
        return response()->json($data);
    }
    public function loadproduk()
    {
        $data = DB::table('produks')->get();
        return response()->json($data);
    }
    public function simpan(Request $request)
    {
        $status = false;
        try {
            $item = $request->data1;
            // foreach ($item as $itm) {
            //     $saveitem = [
            //         [
            //             'nofaktur' => $itm['infoice'],
            //             'kodeproduk' => $itm['kodeproduk'],
            //             'namaproduk' => $itm['namaproduk'],
            //             'harga' => $itm['harga'],
            //             'jumlah' => $itm['jumlah'],
            //             'total' => $itm['total']
            //         ],
            //     ];
            //     DB::table('pembeliandetails')->insert($saveitem);
            // }
            foreach ($item as $t) {
                $simpanitem = [
                    [
                        'nofaktur' => $t['infoice'],
                        'tglbeli' => $t['tglbeli'],
                        'kodepemasok' => $t['kodepemasok'],
                        'bayar' => $t['payment'],
                        'grandtotal' => $t['grandtotal'],
                    ],
                ];
                DB::table('pembelians')->insert($simpanitem);
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
    public function simpangrdttl(Request $request)
    {
        $status = false;
        try {
            $item = $request->data2;
            foreach ($item as $itm) {
                $saveitem = [
                    [
                        'grandtotal' => $itm['grandtotal']
                    ],
                ];
                DB::table('pembelians')->insert($saveitem);
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
    public function loadpembelian()
    {
        $data = DB::table('pembeliandetails')->get();
        return response()->json($data);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
