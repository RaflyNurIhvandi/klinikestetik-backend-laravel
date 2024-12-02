<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datacust = DB::table('pelanggans')->get();
        $hasil = [
            'success' => true,
            'message' => 'Data produk',
            'data' => $datacust,
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
        //
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
                'namapelanggan' => 'required',
                'alamatpelanggan' => 'required',
                'notelppelanggan' => 'required',
                'statepelanggan' => 'required',
                'kotapelanggan' => 'required',
                'kategoripelanggan' => 'required',
            ]);
            $carbon = Carbon::now();
            $getyear = $carbon->now()->format('Y');
            $getmonth = $carbon->now()->format('m');
            $getday = $carbon->format('d');
            $gethours = $carbon->now()->format('H');
            $getminute = $carbon->now()->minute;
            $getsecond = $carbon->now()->second;
            // . $gethours . $getminute . $getsecond
            $getkodecust = "P" . $getyear . $getmonth . $getday . $gethours . $getminute . $getsecond;

            DB::table('pelanggans')->insert([
                'kodepelanggan' => $getkodecust,
                'namapelanggan' => $validatedData['namapelanggan'],
                'alamatpelanggan' => $validatedData['alamatpelanggan'],
                'notelppelanggan' => $validatedData['notelppelanggan'],
                'statepelanggan' => $validatedData['statepelanggan'],
                'kotapelanggan' => $validatedData['kotapelanggan'],
                'kategoripelanggan' => $validatedData['kategoripelanggan'],
            ]);
            // return response()->json($cust);
            $hasil = [
                'success' => true,
                'message' => 'Pelanggan telah ditambahkan',
            ];

            DB::commit();
        } catch (\Exception$e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Pelanggan tidak dapat disimpan',
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
                'namapelanggan' => 'required',
                'alamatpelanggan' => 'required',
                'notelppelanggan' => 'required',
                'statepelanggan' => 'required',
                'kotapelanggan' => 'required',
                'kategoripelanggan' => 'required',
            ]);

            DB::table('pelanggans')->where('id', $id)->update([
                'namapelanggan' => $validatedData['namapelanggan'],
                'alamatpelanggan' => $validatedData['alamatpelanggan'],
                'notelppelanggan' => $validatedData['notelppelanggan'],
                'statepelanggan' => $validatedData['statepelanggan'],
                'kotapelanggan' => $validatedData['kotapelanggan'],
                'kategoripelanggan' => $validatedData['kategoripelanggan'],
            ]);
            // return response()->json($cust);
            $hasil = [
                'success' => true,
                'message' => 'Edit pelanggan telah berhasil',
            ];

            DB::commit();
        } catch (\Exception$e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Edit pelanggan tidak dapat disimpan',
            ];
        }
        return response()->json($hasil);
        // $cust = DB::table('pelanggans')->where('id', $id)->update([
        //     'namapelanggan' => $request->namapelanggan,
        //     'alamatpelanggan' => $request->alamatpelanggan,
        //     'notelppelanggan' => $request->notelppelanggan,
        //     'statepelanggan' => $request->statepelanggan,
        //     'kotapelanggan' => $request->kotapelanggan,
        //     'kategoripelanggan' => $request->kategoripelanggan,
        // ]);

        // return response()->json($cust);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cust = DB::table('pelanggans')->delete($id);
        $hasil = [
            'success' => true,
            'message' => 'Data produk ' . $id . ' telah dihapus',
        ];
        return response()->json($hasil);
    }
    public function getdetail($id)
    {
        $cust = DB::table('pelanggans')->where('id', $id)->get();

        return response()->json($cust);
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
    }
    public function cetak()
    {
        $cetak = DB::table('pelanggans')->get();
        // $pdf = PDF::loadview('faktur.cetak', ['$cetak' => $cetak])->setPaper('A4', 'potrait');
        // return $pdf->stream("$id.pdf");
        return view('datainduk/cetakcustomer', compact("cetak")->setPaper('landscape'));
        // return response()->json($cetak);
    }
    public function cetakpdf()
    {
        // $cetak = DB::select('select * from pelanggans');
        $cetak = DB::table('pelanggans')->get();

        $pdf = PDF::loadView('datainduk/cetakpdfcustomer', compact("cetak"));
        return $pdf->download("data_pelanggan.pdf");
    }
    public function cetakexel()
    {
        $cetak = DB::table('pelanggans')
            ->get();

        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
    ");
        header("Content-Disposition: attachment; filename=Data-pelanggan.xls");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        return view('datainduk/cetakexelcustomer', compact("cetak"));
    }

}
