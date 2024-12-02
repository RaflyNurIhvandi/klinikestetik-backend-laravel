<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

class PemasokController extends Controller
{
    public function load()
    {
        $data = DB::table('pemasoks')->get();
        return response()->json($data);
    }
    public function save(Request $request)
    {
        $kodepemasok = "P" . date("YmdHis");
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'companyname' => 'required',
                'phonenumber' => 'required',
                'contactpersonphone' => 'required',
                'contactperson' => 'required',
            ]);
            $pemasoks = DB::table('pemasoks')->insert([
                'kodepemasok' => $kodepemasok,
                'namapemasok' => $validatedData['companyname'],
                'alamatpemasok' => $request->address,
                'namakontak' => $validatedData['phonenumber'],
                'kotapemasok' => $request->city,
                'provinsi' => $request->state,
                'notelpkontak' => $validatedData['contactperson'],
                'notelppemasok' => $validatedData['contactpersonphone'],
            ]);
            $hasil = [
                'success' => true,
                'message' => 'Data pemasoks telah ditambahkan'
            ];

            DB::commit($pemasoks);
        } catch (\Exception $e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Data pemasoks tidak dapat disimpan'
            ];
        }
        return response()->json($hasil);
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'companyname' => 'required',
                'phonenumber' => 'required',
                'contactpersonphone' => 'required',
                'contactperson' => 'required',
            ]);
            DB::table('pemasoks')->where('id', $id)->update([
                'namapemasok' => $validatedData['companyname'],
                'alamatpemasok' => $request->address,
                'namakontak' => $validatedData['phonenumber'],
                'kotapemasok' => $request->city,
                'provinsi' => $request->state,
                'notelpkontak' => $validatedData['contactperson'],
                'notelppemasok' => $validatedData['contactpersonphone'],
            ]);

            $hasil = [
                'success' => true,
                'message' => 'Data pemasoks telah ditambahkan'
            ];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Data pemasoks tidak dapat disimpan'
            ];
        }
        return response()->json($hasil);
    }
    public function delete($id)
    {
        $data = DB::table('pemasoks')->where('id', $id)->delete();
        $hasil = [
            'success' => true,
            'message' => 'Data pemasoks ' . $id . ' telah dihapus',
        ];
        return response()->json($hasil);
    }
    public function cetak()
    {
        $pemasok = DB::table('pemasoks')->get();
        return view('datainduk.cetakprintpemasok', compact('pemasok'));
    }
    public function excel()
    {
        $pemasok = DB::table('pemasoks')->get();
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=DATA_PEMASOKS.xls");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");

        return view('datainduk.cetakexelpemasok', compact('pemasok'));
    }
    public function pdf()
    {
        $pemasok = DB::table('pemasoks')->get();
        $pdf = PDF::loadview('datainduk.cetakpdfpemasok', ['pemasok' => $pemasok]);
        return $pdf->download('Data_pemasok.pdf');
    }
}
