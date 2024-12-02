<?php

namespace App\Http\Controllers;

// use App\Models\Uploads;
// use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Image;
// use App\Pernyataans;

class PernyataanController extends Controller
{
    public function index()
    {
        // return view('upload');
        $data = DB::table('pernyataans')->get();
        $hasil = [
            'success' => true,
            'message' => 'Pernyataan Terapis',
            'data' => $data
        ];
        return response()->json($hasil);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'filepernyataan' => 'required|file|mimes:jpeg,jpg,png|max:2048'
        // ]);

        // Storage::disk('public')->putFileAs('/img/uploads/pernyataan', new File($validatedData['filepernyataan']), pathinfo($validatedData['filepernyataan']->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $validatedData['filepernyataan']->getClientOriginalExtension());

        // $image_name = pathinfo($validatedData['filepernyataan']->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $validatedData['filepernyataan']->getClientOriginalExtension();

        // $pernyataans = Pernyataans::create([
        //     'picture' => $image_name
        // ]);

        // $pernyataans->save();

        // return response(['pernyataan' => $pernyataans], 201);

        // -----

        // $validate = $request->validate([
        //     'nama' => 'required',
        //     'tanggal' => 'required',
        //     'filepernyataan' => 'required|max:2048|file|image|mimes:png,jpg,jpeg'
        // ]);

        // DB::beginTransaction();
        // try {
        //     $nama = $request->nama;
        //     $tanggal = $request->tanggal;
        //     $nmfoto = '';

        //     $savePernyataan = Pernyataans::create([
        //         'nama' => $nama,
        //         'tanggal' => $tanggal,
        //         'filepernyataan' => $nmfoto
        //     ]);
        //     $idterakhir = $savePernyataan->id;
        //     if($request->hasFile('foto')) {
        //         $filepernyataan = $request->file('filepernyataan');

        //         $size = $filepernyataan->getSize();
        //         $ext = $filepernyataan->getClientOriginalExtension();
        //         $nmfoto = $filepernyataan->getClientOriginalName();

        //         $alamatTujuan = 'images/';
        //     }
        //     DB::commit();
        //     return redirect('programmers')->with('pesan', 'Data has been saved!');
        // } catch(\Exception $e) {
        //     DB::rollBack();
        //     return redirect('pernyataans')->with('err', 'Data cannot saved!');
        // }

        // -----

        // $this->validate($request, array(
        //     'tanggal' => 'required',
        //     'filepernyataan' => 'image|mimes:jpeg,jpg,png,svg|max:2048'
        // ));

        // $pernyataan = new pernyataan;
        // $pernyataan->tanggal = $request->tanggal;

        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $filename = time() . '.' . $image->getClientOriginalExtension();
        //     Image::make($image)->resize(300, 300)->save(storage_path('/uploads/' . $filename));
        //     $pernyataan->image = $filename;
        //     $pernyataan->save();
        // };

        // $pernyataan->save();

        // return redirect()->route('store')
        //     ->with('success', 'Item created successfully');

        // -----

        // $this->validate($request, [
        //     'tanggal' => 'required',
        //     'filepernyataan' => 'image|mimes:jpeg,jpg,png,svg|max:2048'
        // ]);

        // $file = $request->file('filepernyataan');
        // $extension = $request->image->extension();
        // $path = $request->image->store('uploads');

        // $image = 'hi';
        // $request->image = 'hi';

        // Person::create($request->all());
        // return redirect()->route('people.index')
        //     ->with('success', 'item created successfully');

        // -----

        // $request->validate([
        //     // 'nama' => 'required',
        //     'tanggal' => 'required'
        // ]);

        // if ($request->hasFile('filepernyataan')) {
        //     $request->validate([
        //         'image' => 'mimes:jpeg,jpg,png,bmp'
        //     ]);
        //     $request->filepernyataan->store('images', 'public');

        //     $pernyataan = new Pernyataan([
        //         // "nama" => $request->get('nama'),
        //         "tanggal" => $request->get('tanggal'),
        //         "filepernyataan" => $request->filepernyataan->hasName()
        //     ]);
        //     $pernyataan->save();
        // }
        // return view('pernyataans.create');

        // -----

        // $request->validate([
        //     'tanggal' => 'required',
        //     'filepernyataan' => 'required',
        //     'filepernyataan' => 'mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000'
        // ]);
        // if ($request->hasfile('filepernyataan')) {
        //     $filepernyataan = round(microtime(true) * 1000).'-'.str_replace('','-',$request->file('filepernyataan')->getClientOriginalName());
        //     $request->file('filepernyataan')->move(public_path('images'), $filepernyataan);

        //     Uploads::create([
        //         'filepernyataan' => $filepernyataan
        //     ]);
        //     echo 'Success';
        // } else {
        //     echo 'Gagal';
        // }

        // -----

        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'nama' => 'required',
                'tanggal' => 'required',
                // 'filepernyataan' => 'required',
                'filepernyataan' => 'required|max:500|file|image|mimes:jpg,jpeg'
            ]);

            $pernyataans = DB::table('pernyataans')->insert([
                'nama' => $validatedData['nama'],
                'tanggal' => $validatedData['tanggal'],
                'filepernyataan' => $validatedData['filepernyataan']
            ]);

            $hasil = [
                'success' => true,
                'message' => 'Pernyataan Terapis Telah Ditambahkan!'
            ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $hasil = [
                'success' => false,
                'message' => 'Pernyataan Terapis Tidak Dapat Disimpan!'
            ];
        }
        return response()->json($hasil);
    }

    public function show($id)
    {
        // $data = DB::table('pernyataans')->where('id', $id)->get();
        // $hasil = [
        //     'success' => true,
        //     'message' => 'Data Pegawai '.$id,
        //     'data' => $data,
        // ];
        // return response()->json($hasil);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
