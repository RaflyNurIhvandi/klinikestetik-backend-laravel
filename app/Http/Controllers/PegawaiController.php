<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

class PegawaiController extends Controller
{

    public function index()
    {
        $data = DB::table('pegawais')->get();
        $hasil = [
            'success' => true,
            'message' => 'Data Pegawai',
            'data' => $data,
        ];
        return response()->json($hasil);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $kodepegawai = "P".date("YmdHis");

        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                // 'kodepegawai' => 'required',
                // 'emailpegawai' => 'required',
                'password' => 'required',
                'namapegawai' => 'required',
                'jabatanpegawai' => 'required',
                'alamatpegawai' => 'required',
                // 'kotapegawai' => 'required',
                // 'provinsipegawai' => 'required',
                'notelppegawai' => 'required',
                // 'kodecabang' => 'required',
                ]);

            $pegawai=DB::table('pegawais')->insert([
                'kodepegawai' => $kodepegawai,
                // 'emailpegawai' => $validatedData['emailkaryawan'],
                'password' => $validatedData['password'],
                'namapegawai' => $validatedData['namapegawai'],
                'jabatanpegawai' => $validatedData['jabatanpegawai'],
                'alamatpegawai' => $validatedData['alamatpegawai'],
                'kotapegawai' => $request->kotapegawai,
                'provinsipegawai' => $request->provinsipegawai,
                'notelppegawai' => $validatedData['notelppegawai'],
                // 'kodecabang' => $validatedData['kodecabang'],
                ]);

                $hasil = [
                    'success' => true,
                    'message' => 'Data Pegawai Telah Ditambahkan!'
                ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Data Pegawai Tidak Dapat Disimpan!'
            ];
        }

        return response()->json($hasil);
    }

    public function show($id)
    {
        $data = DB::table('pegawais')->where('kodepegawai',$id)->get();
        $hasil = [
            'success' => true,
            'message' => 'Data Pegawai '.$id,
            'data' => $data,
        ];
        return response()->json($hasil);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // $kodepegawai = "P".date('YmdHis');
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                // 'emailpegawai' => 'required',
                'password' => 'required',
                'namapegawai' => 'required',
                'jabatanpegawai' => 'required',
                'alamatpegawai' => 'required',
                'kotapegawai' => 'required',
                'notelppegawai' => 'required',
                'provinsipegawai' => 'required',
                // 'kodecabang' => 'required',
                ]);

            $pegawai=DB::table('pegawais')
            ->where('id',$id)
            ->update([
                // 'emailpegawai' => $validatedData['emailkaryawan'],
                'password' => $validatedData['password'],
                'namapegawai' => $validatedData['namapegawai'],
                'jabatanpegawai' => $validatedData['jabatanpegawai'],
                'alamatpegawai' => $validatedData['alamatpegawai'],
                'kotapegawai' => $validatedData['kotapegawai'],
                'notelppegawai' => $validatedData['notelppegawai'],
                'provinsipegawai' => $validatedData['provinsipegawai'],
                // 'kodecabang' => $validatedData['kodecabang'],
                ]);

                $hasil = [
                    'success' => true,
                    'message' => 'Data Pegawai Telah Diubah!'
                ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Data Pegawai Tidak Dapat Diubah!'
            ];
        }

        return response()->json($hasil);
    }

    public function destroy($id)
    {
        $data = DB::table('pegawais')->where('kodepegawai',$id)->delete();
        $hasil = [
            'success' => true,
            'message' => 'Data Pegawai '.$id. ' Telah Dihapus!',
        ];
        return response()->json($hasil);
    }

    public function cetak()
    {
        // $data = DB::table('pegawais')->where('kodepegawai', $kodepegawai)->get();
        $data = DB::table('pegawais')->get();
        
        return view('cetak', compact('data'));
    }

    public function excel()
    {
        $data = DB::table('pegawais')->get();

        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Data_Pegawai.xls");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");

        return view('excel', compact('data'));
    }

    public function pdf()
    {
        $data = DB::table('pegawais')->get();
  
        $pdf = PDF::loadView('pdf', ['data' => $data]);
        
        return $pdf->download('Data_Pegawai.pdf');
    }
}
