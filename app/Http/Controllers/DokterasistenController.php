<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DokterasistenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dktr = DB::table('pegawais')
            ->where('jabatanpegawai', '=', 'D')
            ->orWhere('jabatanpegawai', '=', 'A')
            ->orWhere('jabatanpegawai', '=', 'T')

            ->get();
        $hsl = [
            'success' => true,
            'message' => 'Data produk',
            'data' => $dktr,
        ];

        return response()->json($hsl);
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
    public function getkodepegawai()
    {
        $carbon = Carbon::now();
        $getyear = $carbon->now()->format('Y');
        $getmonth = $carbon->now()->format('m');
        $getday = $carbon->format('d');
        $gethours = $carbon->now()->format('H');
        $getminute = $carbon->now()->minute;
        $getsecond = $carbon->now()->second;

        $kode = $request->jabatanpegawai;
        $getfaktur = $getyear . $getmonth . $getday . $gethours . $getminute . $getsecond;

        return response()->json($getfaktur);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                // 'kodepegawai' => 'required',
                'namapegawai' => 'required',
                'alamatpegawai' => 'required',
                'notelppegawai' => 'required',
                'kotapegawai' => 'required',
                'jabatanpegawai' => 'required',
            ]);
            $carbon = Carbon::now();
            $getyear = $carbon->now()->format('Y');
            $getmonth = $carbon->now()->format('m');
            $getday = $carbon->format('d');
            $gethours = $carbon->now()->format('H');
            $getminute = $carbon->now()->minute;
            $getsecond = $carbon->now()->second;
            // . $gethours . $getminute . $getsecond

            $kode = $request->jabatanpegawai;
            $getkodeemp = $kode . $getyear . $getmonth . $getday . $gethours . $getminute . $getsecond;

            DB::table('pegawais')->insert([
                'kodepegawai' => $getkodeemp,
                'namapegawai' => $validatedData['namapegawai'],
                'alamatpegawai' => $validatedData['alamatpegawai'],
                'notelppegawai' => $validatedData['notelppegawai'],
                'kotapegawai' => $validatedData['kotapegawai'],
                'provinsipegawai' => $request->statepegawai,
                'jabatanpegawai' => $validatedData['jabatanpegawai'],
                // 'komisi' => $request->komisi,
            ]);
            $hasil = [
                'success' => true,
                'message' => 'Pegawai telah ditambahkan',
            ];

            DB::commit();
        } catch (\Exception$e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Pegawai tidak dapat disimpan',
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
                // 'kodepegawai' => 'required',
                'namapegawai' => 'required',
                'alamatpegawai' => 'required',
                'notelppegawai' => 'required',
                'kotapegawai' => 'required',
                'jabatanpegawai' => 'required',
            ]);
            $dktr = DB::table('pegawais')->where('id', $id)->update([
                'namapegawai' => $request->namapegawai,
                'alamatpegawai' => $request->alamatpegawai,
                'notelppegawai' => $request->notelppegawai,
                'kotapegawai' => $request->kotapegawai,
                'provinsipegawai' => $request->statepegawai,
                'jabatanpegawai' => $request->jabatanpegawai,
                // 'komisi' => $request->komisi,
            ]);

            $hasil = [
                'success' => true,
                'message' => 'Pegawai telah diubah',
            ];

            DB::commit();
        } catch (\Exception$e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Pegawai tidak dapat diubah',
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
        $dkter = DB::table('pegawais')->delete($id);
        $hasil = [
            'success' => true,
            'message' => 'Data produk ' . $id . ' telah dihapus',
        ];
        return response()->json($hasil);
    }
    public function cetak()
    {
        $cetak = DB::table('pegawais')
            ->where('jabatanpegawai', '=', 'D')
            ->orWhere('jabatanpegawai', '=', 'A')
            ->orWhere('jabatanpegawai', '=', 'T')
            ->get();
        // $pdf = PDF::loadview('faktur.cetak', ['$cetak' => $cetak])->setPaper('A4', 'potrait');
        // return $pdf->stream("$id.pdf");
        return view('datainduk/cetakdokterterapis', compact("cetak"));
        // return response()->json($cetak);
    }
    public function cetakpdf()
    {
        // $cetak = DB::select('select * from pelanggans');
        $cetak = DB::table('pegawais')
            ->where('jabatanpegawai', '=', 'D')
            ->orWhere('jabatanpegawai', '=', 'A')
            ->orWhere('jabatanpegawai', '=', 'T')
            ->get();

        $pdf = PDF::loadView('datainduk/cetakpdfdokterterapis', compact("cetak"));
        return $pdf->download("data_dokter_terapis_asisten.pdf");
    }
    public function cetakexel()
    {
        $cetak = DB::table('pegawais')
            ->where('jabatanpegawai', '=', 'D')
            ->orWhere('jabatanpegawai', '=', 'A')
            ->orWhere('jabatanpegawai', '=', 'T')
            ->get();

        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
    ");
        header("Content-Disposition: attachment; filename=Data-pelanggan.xls");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        return view('datainduk/cetakexeldokterterapis', compact("cetak"));
    }
}
