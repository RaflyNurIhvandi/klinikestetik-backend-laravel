<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperasionalBarangController extends Controller
{
    public function index($id)
    {
        $data = DB::table('operasionals')->where('kategori', $id)->get();
        return response()->json($data);
    }
    public function save(Request $request)
    {
        DB::beginTransaction();
        $kategori = "barang";
        try {
            $item = $request->data1;
            foreach ($item as $br) {
                $simpan = [
                    [
                        'kategori' => $kategori,
                        'namatoko' => $br['namatoko'],
                        'noreferensi' => $br['noreferensi'],
                        'tgl' => $br['tgl'],
                        'nama' => $br['nama'],
                        'harga' => $br['harga'],
                        'jumlah' => $br['jumlah'],
                        'total' => $br['total']
                    ],
                ];
                DB::table('operasionals')
                    ->insert($simpan);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $msge = [
                'success' => false,
                'message' => 'Operasional gagal!',
            ];
            return response()->json($msge);
        }
        DB::commit();
        $msgs = [
            'success' => true,
            'message' => 'Operasional Berhasil disimpan',
        ];
        return response()->json($msgs);
    }
}
