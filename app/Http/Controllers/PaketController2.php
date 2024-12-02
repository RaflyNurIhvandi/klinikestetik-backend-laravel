<?php

namespace App\Http\Controllers;

use Exception;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    public function index()
    {
        $data = DB::table('produkpakets')->get();
        return response()->json($data);
    }
    public function indexpack()
    {
        $data = DB::table('produks')->get();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        // return $request;
        $kode = "PP".date('YmdHis');
        $grup = "PP";
        DB::beginTransaction();
        try{
            DB::table('produks')
            ->insert([
                'kodeproduk' => $kode,
                'namaproduk' => $request->data1['namapaket'],
                'kodegrup' => $grup,
                'deskripsi' => $request->data1['deskripsi'],
                'hargajual' => $request->data1['hargaitem'],
                'tglkadaluarsa'=> $request->data1['expired_date']
            ]);
            $itm = $request->data2;
            foreach ($itm as $prdk) {
                $simpandetail = [
                    [
                        'kodepaket' => $kode,
                        'namapaket' => $request->data1['namapaket'],
                        'deskripsi' => $request->data1['deskripsi'],
                        'kodeitem' => $prdk['kodeproduk'],
                        'namaitem' => $prdk['namaproduk'],
                        'hargaitem' => $prdk['hargajual'],
                    ]
                ];
                DB::table('produkpakets')->insert($simpandetail);
            }
            $hasil = [
                'success' => true,
                'message' => 'Data telah ditambahkan'
            ];
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            $hasil = [
                'success' => false,
                'message' => 'Data tidak dapat disimpan'
            ];
        }
        return response()->json($hasil);
    }
    // public function tambahitem(Request $request)
    // {
    //     $kode = "PP".date('YmdHis');
    //     $grup = "PP";
    //     DB::beginTransaction();
    //     try{
    //         $validateData = $request->validate([
    //             'nama' => 'required',
    //             'stok' => 'required',
    //             'harga' => 'required',
    //         ]);
    //         DB::table('produkpakets')->insert([
    //             'kodepaket'=> $kode,
    //             'namapaket'=> $validateData['nama'],
    //             'jmlitem'=> $validateData['stok'],
    //             'hargaitem'=> $validateData['harga'],
    //             'expired_date' => $request->tgl,
    //             'deskripsi' => $request->des,
    //         ]);
    //         DB::table('produks')->insert([
    //             'kodeproduk'=>$kode,
    //             'kodegrup'=>$grup,
    //             'namaproduk'=>$validateData['nama'],
    //             'hargajual'=>$validateData['harga'],
    //             'stokmin'=>$validateData['stok'],
    //             'tglkadaluarsa'=>$request->tgl,
    //             'deskripsi'=>$request->des,
    //         ]);
    //         $hasil = [
    //             'success' => true,
    //             'message' => 'Data telah ditambahkan'
    //         ];
    //         DB::commit();
    //     }
    //     catch(\Exception $e){
    //         DB::rollBack();
    //         $hasil = [
    //             'success' => false,
    //             'message' => 'Data tidak dapat disimpan'
    //         ];
    //     }
    //     return response()->json($hasil);
    // }
    // public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();
    //     try{
    //         $validateData = $request->validate([
    //             'namapaket' => 'required',
    //             'jmlitem' => 'required',
    //             'hargaitem' => 'required',
    //         ]);
    //         DB::table('produkpakets')->where('id', $id)->update([
    //             'namapaket'=> $validateData['namapaket'],
    //             'jmlitem'=> $validateData['jmlitem'],
    //             'hargaitem'=> $validateData['hargaitem'],
    //             'expired_date' => $request->expired_date,
    //             'deskripsi' => $request->deskripsi,
    //         ]);
    //         DB::table('produks')->where('id', $id)->update([
    //             'namaproduk'=>$validateData['namapaket'],
    //             'hargajual'=>$validateData['hargaitem'],
    //             'stokmin'=>$validateData['jmlitem'],
    //             'tglkadaluarsa'=>$request->expired_date,
    //             'deskripsi'=>$request->deskripsi,
    //         ]);
    //         $hasil = [
    //             'success' => true,
    //             'message' => 'Data telah diubah'
    //         ];
    //         DB::commit();
    //     }
    //     catch(\Exception $e){
    //         DB::rollBack();
    //         $hasil = [
    //             'success' => false,
    //             'message' => 'Data tidak dapat diubah'
    //         ];
    //     }
    //     return response()->json($hasil);
    // }
}
