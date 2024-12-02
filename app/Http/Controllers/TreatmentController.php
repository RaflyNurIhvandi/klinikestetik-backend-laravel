<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

class TreatmentController extends Controller
{
    public function cetak($kodegrup)
    {
        $treatment = DB::table('produks')->where('kodegrup', $kodegrup)->get();
        return view('cetak', compact('treatment'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = DB::table('produks')->where('kodegrup',$id)->get();
        $hasil = [
            'success' => true,
            'message' => 'Data Treatment',
            'data' => $data,
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
        $kodeproduk = "T".date('YmdHis');
        DB::beginTransaction();
        try {
            $validateData = $request->validate([
                $kodegrup = "T",
                'namaproduk' => 'required',
                'hargajual' => 'required',
                'deskripsi' => 'required',
            ]);
            DB::table('produks')->insert([
                'kodeproduk' => $kodeproduk,
                'kodegrup' => $kodegrup,
                'namaproduk' => $validateData ['namaproduk'],
                'hargajual' => $validateData ['hargajual'],
                'deskripsi' => $validateData ['deskripsi'],
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('produks')->where('kodegrup',$id)->get();
        $hasil = [
            'success' => true,
            'message' => 'Data treatment '.$id,
            'data' => $data,
        ];
        return response()->json($hasil);
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
        DB::beginTransaction($id);
        try {
            $validateData = $request->validate([
                $kodegrup = "T",
                'namaproduk' => 'required',
                'hargajual' => 'required',
                'deskripsi' => 'required',
            ]);
            DB::table('produks')
            ->where('id',$id)
            ->update([
                'kodegrup' => $kodegrup,
                'namaproduk' => $validateData ['namaproduk'],
                'hargajual' => $validateData ['hargajual'],
                'deskripsi' => $validateData ['deskripsi'],
            ]);
            $hasil = [
                'success' => true,
                'message' => 'Data treatment telah diubah'
            ];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $hasil = [
                'success' => false,
                'message' => 'Data treatment tidak dapat diubah'
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
        DB::table('produks')->where('kodeproduk',$id)->delete();
        $hasil = [
            'success' => true,
            'message' => 'Data Treatment'.$id.' telah dihapus ',
        ];
        return response()->json($hasil);
    }
    public function excel($kodegrup)
    {
        $treatment = DB::table('produks')->where('kodegrup', $kodegrup)->get();
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Data_Treatment.xls");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        return view('excel', compact('treatment'));
    }
    public function exportPDF($kodegrup) 
    {
        $treatment = DB::table('produks')->where('kodegrup', $kodegrup)->get();
        $pdf = PDF::loadView('pdf', ['treatment' => $treatment]);
        return $pdf->download('Data_Treatment.pdf');
      }
}
// zahwa