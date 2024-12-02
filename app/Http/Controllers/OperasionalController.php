<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kategori)
    {
        $data = DB::table('operasionals')->where('kategori', $kategori)->get();
        return response()->json($data);
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
    // public function show($kategori)
    // {
    //     $data = DB::table('operasionals')->where('kategori', $kategori)->get();
    //     return response()->json($data);
    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
