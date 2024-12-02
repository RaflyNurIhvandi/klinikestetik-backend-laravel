<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OperasionalTreatController extends Controller
{
    public function index($kategori)
    {
        $data = DB::table('operasionals')->where('kategori', $kategori)->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $status = false;
        $kategori="Jasa";
        try{
            $item = $request->datasv;
            foreach($item as $i){
                $itemsave = [
                    [
                        'kategori' => $kategori,
                        'tgl' => $i['date'],
                        'namatoko' => $i['namatoko'],
                        'noreferensi' => $i['referensi'],
                        'nama' => $i['namaproduk'],
                        'harga' => $i['harga'],
                        'jumlah' => $i['jumlah'],
                        'total' => $i['total']
                    ],
                ];
                DB::table('operasionals')->insert($itemsave);
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
}
