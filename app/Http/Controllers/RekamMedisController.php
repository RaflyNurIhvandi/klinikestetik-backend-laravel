<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function getcust($id)
    {
        $cust = DB::table('pelanggans')->where('kodepelanggan', $id)->get();
        $hsl = [
            'success' => true,
            'message' => 'Customer',
            'data' => $cust,
        ];

        return response()->json($hsl);
    }
    public function getdate()
    {
        $carbon = Carbon::now();
        $get = $carbon->now()->format('Y-m-d');

        return response()->json($get);
    }
    public function getinvoice($id)
    {
        $cust = DB::table('penjualans')
            ->where('kodepelanggan', $id)
            ->get();
        $hsl = [
            'success' => true,
            'message' => 'invoice',
            'data' => $cust,
        ];

        return response()->json($hsl);
    }
    public function store(Request $request)
    {
        $carbon = Carbon::now();
        $get = $carbon->now()->format('YmdHis');
        // header('Access-Control-Allow-Origin: *');
        $fo1 = $request->file('foto1');
        $fo2 = $request->file('foto2');
        $fo3 = $request->file('foto3');
        $kdpl = $request->kodepelanggan;
        if($fo1 == null || $fo2 == null || $fo3 == null){
            $namafoto1 = "";
            $namafoto2 = "";
            $namafoto3 = "";
        } else if ($fo2 == null || $fo3 == null) {
            $namafoto1 = 'img1' . $kdpl . '_' . $get . '.' . $fo1->getClientOriginalExtension();
            $namafoto2 = "";
            $namafoto3 = "";
            $tujuan_upload = 'img/rekammedis';
            $fo1->move($tujuan_upload, $namafoto1);
        } else if ($fo3 == null) {
            $namafoto1 = 'img1' . $kdpl . '_' . $get . '.' . $fo1->getClientOriginalExtension();
            $namafoto2 = 'img2' . $kdpl . '_' . $get . '.' . $fo2->getClientOriginalExtension();
            $namafoto3 = "";
            $tujuan_upload = 'img/rekammedis';
            $fo1->move($tujuan_upload, $namafoto1);
            $fo2->move($tujuan_upload, $namafoto2);
        } else {
            $namafoto1 = 'img1' . $kdpl . '_' . $get . '.' . $fo1->getClientOriginalExtension();
            $namafoto2 = 'img2' . $kdpl . '_' . $get . '.' . $fo2->getClientOriginalExtension();
            $namafoto3 = 'img3' . $kdpl . '_' . $get . '.' . $fo3->getClientOriginalExtension();
            $tujuan_upload = 'img/rekammedis';
            $fo1->move($tujuan_upload, $namafoto1);
            $fo2->move($tujuan_upload, $namafoto2);
            $fo3->move($tujuan_upload, $namafoto3);
        }
        // $namafoto3 = 'img3' . $kdpl . '_' . $get . '.' . $fo3->getClientOriginalExtension();

        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'nofaktur' => 'required',
                'tanggal' => 'required',
                'kodepelanggan' => 'required',
                'diagnosa' => 'required',
                'produk' => 'required',
                'keterangan' => 'required',
            ]);

            $csds = DB::table('rekammediks')->insert([
                'nofaktur' => $validatedData['nofaktur'],
                'tanggal' => $validatedData['tanggal'],
                'kodepelanggan' => $validatedData['kodepelanggan'],
                'diagnosa' => $validatedData['diagnosa'],
                'produk' => $validatedData['produk'],
                'keterangan' => $validatedData['keterangan'],
                'keterangan1' => $request->keterangan1,
                'keterangan2' => $request->keterangan2,
                'keterangan3' => $request->keterangan3,
                'gambar1' => $namafoto1,
                'gambar2' => $namafoto2,
                'gambar3' => $namafoto3,
            ]);
            $hasil = [
                'success' => true,
                'message' => 'rekam medik telah ditambahkan',
                'data' => $csds,

            ];
            DB::commit();
        } catch (\Exception$e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Rekam medik tidak dapat disimpan',
            ];
        }
        return response()->json($hasil);
    }
    public function getallcust()
    {
        $cust = DB::table('pelanggans')->get();
        $hasil = [
            'success' => true,
            'data' => $cust,
        ];
        return response()->json($hasil);
    }

}
