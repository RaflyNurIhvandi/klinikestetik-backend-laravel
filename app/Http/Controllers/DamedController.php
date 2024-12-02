<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DamedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $damed = DB::table('produks')->where('kodegrup', '=', 'M')->get();
        $hasil = [
            'success' => true,
            'message' => 'Data produk',
            'data' => $damed,
        ];

        return response()->json($hasil);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                // 'kodepelanggan' => 'required',
                'namaproduk' => 'required',
                'hargajual' => 'required',
                'deskripsi' => 'required',
            ]);
            $carbon = Carbon::now();
            $getyear = $carbon->now()->format('Y');
            $getmonth = $carbon->now()->format('m');
            $getday = $carbon->format('d');
            $gethours = $carbon->now()->format('H');
            $getminute = $carbon->now()->minute;
            $getsecond = $carbon->now()->second;
            // . $gethours . $getminute . $getsecond
            $getkodeprod = "M" . $getyear . $getmonth . $getday . $gethours . $getminute . $getsecond;
            $damed = DB::table('produks')->insert([
                'kodeproduk' => $getkodeprod,
                'namaproduk' => $validatedData['namaproduk'],
                'kodegrup' => $request->kodegrup,
                'hargajual' => $validatedData['hargajual'],
                'deskripsi' => $validatedData['deskripsi'],
            ]);
            $hasil = [
                'success' => true,
                'message' => 'Produk telah ditambahkan',
            ];
            DB::commit();
        } catch (\Exception$e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Produk tidak dapat disimpan',
            ];
        }

        return response()->json($hasil);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                // 'kodepelanggan' => 'required',
                'namaproduk' => 'required',
                'hargajual' => 'required',
                'deskripsi' => 'required',
            ]);
            $damed = DB::table('produks')->where('id', $id)->update([
                'namaproduk' => $validatedData['namaproduk'],
                'hargajual' => $validatedData['hargajual'],
                'deskripsi' => $validatedData['deskripsi'],
            ]);

            $hasil = [
                'success' => true,
                'message' => 'Edit produk telah berhasil',
            ];

            DB::commit();
        } catch (\Exception$e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Edit produk tidak dapat disimpan',
            ];
        }
        return response()->json($hasil);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $damed = DB::table('produks')->delete($id);
        $hasil = [
            'success' => true,
            'message' => 'Data produk ' . $id . ' telah dihapus',
        ];
        return response()->json($hasil);
    }
    public function cetak()
    {
        $cetak = DB::table('produks')
            ->where('kodegrup', '=', 'M')
            ->get();
        // $pdf = PDF::loadview('faktur.cetak', ['$cetak' => $cetak])->setPaper('A4', 'potrait');
        // return $pdf->stream("$id.pdf");
        return view('datainduk/cetakdatamedis', compact("cetak"));
        // return response()->json($cetak);
    }
    public function cetakpdf()
    {
        // $cetak = DB::select('select * from pelanggans');
        $cetak = DB::table('produks')
            ->where('kodegrup', '=', 'M')
            ->get();

        $pdf = PDF::loadView('datainduk/cetakpdfdatamedis', compact("cetak"));
        return $pdf->download("data_medis.pdf");
    }
    public function cetakexel()
    {
        $cetak = DB::table('produks')
            ->where('kodegrup', '=', 'M')
            ->get();

        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
    ");
        header("Content-Disposition: attachment; filename=Data-medis.xls");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        return view('datainduk/cetakexeldatamedis', compact("cetak"));
    }
}
