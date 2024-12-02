<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

class ProdukController extends Controller
{
    public function load($kodegrup)
    {
        $data = DB::table('produks')->where('kodegrup', $kodegrup)->get();
        return response()->json($data);
    }
    public function simpan(Request $request)
    {
        $kode = "B".date('YmdHis');
        DB::beginTransaction();
        try{
            $valid = $request->validate([
                'productname' => 'required',
                'sellingprice' => 'required',
                'category' => 'required',
            ]);
            DB::table('produks')->insert([
                'kodeproduk' => $kode,
                'namaproduk' => $valid['productname'],
                'kodegrup' => $valid['category'],
                'merk' => $request->brand,
                'deskripsi' => $request->des,
                'hargabeli' => $request->purchaseprice,
                'hargajual' => $valid['sellingprice'],
                'stokmin' => $request->minimumstok,
                'tglkadaluarsa' => $request->expierddate
            ]);
            $hasil = [
                'success' => true,
                'message' => 'Data treatment telah ditambahkan'
            ];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Data treatment tidak dapat disimpan'
            ];
        }
         return response()->json($hasil);
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $valided = $request->validate([
                'productname' => 'required',
                'sellingprice' => 'required',
                'category' => 'required'
            ]);
            DB::table('produks')->where('id', $id)->update([
                'namaproduk' => $valided['productname'],
                'kodegrup' => $valided['category'],
                'merk' => $request->brand,
                'deskripsi' => $request->des,
                'hargabeli' => $request->purchaseprice,
                'hargajual' => $valided['sellingprice'],
                'stokmin' => $request->minimumstok,
                'tglkadaluarsa' => $request->expierddate
            ]);
            $hasil = [
                'success' => true,
                'message' => 'Data treatment telah ditambahkan'
            ];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Data treatment tidak dapat disimpan'
            ];
        }
         return response()->json($hasil);
    }
    public function delete($id)
    {
        $data = DB::table('produks')->where('kodeproduk', $id)->delete();
        $hasil = [
            'success' => true,
            'message' => 'Data dengan kode produk '.$id.'telah dihapus',
            'data' => $data
        ];
        return response()->json($hasil);
    }
    public function print($kodegrup)
    {
        $data = DB::table('produks')->where('kodegrup', $kodegrup)->get();
        return view('datainduk.cetakprintbarang', compact('data'));
    }
    public function excel($kodegrup)
    {
        $data = DB::table('produks')->where('kodegrup', $kodegrup)->get();
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Data_Barang.xls");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        return view('datainduk.cetakexcelbarang', compact('data'));
    }
    public function pdf($kodegrup)
    {
        $data = DB::table('produks')->where('kodegrup', $kodegrup)->get();
        $pdf = PDF::loadView('datainduk.cetakpdfbarang', ['data' => $data]);
        return $pdf->download('Data_Barang.pdf');
    }
}
