<?php

use App\Http\Controllers\DamedController;
use App\Http\Controllers\DokterasistenController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\KomisiController;
use App\Http\Controllers\LappromoController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\PenjualanMedisController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperasionalController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\PenjualantreatmentController;
use App\Http\Controllers\OperasionalTreatController;
use App\Http\Controllers\OperasionalBarangController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\CatatanPembelianController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// penerimaan barang
Route::get('/kodepm', [PenerimaanBarangController::class, 'cariKode']);
Route::get('/kodepro', [PenerimaanBarangController::class, 'kodepro']);
Route::post('/simpan/stok', [PenerimaanBarangController::class, 'save']);
Route::get('/show/penerimaan', [PenerimaanBarangController::class, 'showpenerimaan']);
Route::get('/show/datapemasok', [PenerimaanBarangController::class, 'showdatapemasok']);
Route::put('/update/penerimaandetails/{id}', [PenerimaanBarangController::class, 'update']);
Route::put('/update/penerimaanbarangs/{noterima}', [PenerimaanBarangController::class, 'updatepen']);
Route::get('/print/peneriman', [PenerimaanBarangController::class, 'loadprint']);
Route::get('/cetak/print/penerimaan/{id}', [PenerimaanBarangController::class, 'cetak']);

// laporan paket promo
Route::get('/lappro', [LappromoController::class, 'index']);
Route::get('/print/promo', [LappromoController::class, 'print']);
Route::get('/excel/promo', [LappromoController::class, 'excel']);
Route::get('/pdf/promo', [LappromoController::class, 'pdf']);

// paket produks
Route::get('/paket', [PaketController::class, 'index']);
Route::get('/pack', [PaketController::class, 'indexpack']);
Route::post('/pack/save', [PaketController::class, 'store']);
Route::post('/item/save', [PaketController::class, 'tambahitem']);
Route::put('/update/pack/{id}', [PaketController::class, 'update']);

// TREATMENT
Route::get('/treatment/{id}', [TreatmentController::class, 'index']);
Route::post('/treatment/send/T', [TreatmentController::class, 'store']);
Route::put('/treatment/update/T/{id}', [TreatmentController::class, 'update']);
Route::delete('/treatment/delete/T/{id}', [TreatmentController::class, 'destroy']);
Route::get('/cetak/{kodegrup}', [TreatmentController::class, 'cetak']);
Route::get('/excel/{kodegrup}', [TreatmentController::class, 'excel']);
Route::get('/exportPDF/{kodegrup}', [TreatmentController::class, 'exportPDF']);
//laporan treatment
Route::get('/penjualan', [PenjualantreatmentController::class, 'index']);
//operasional jasa
Route::post('/save/operasionaltreat', [OperasionalTreatController::class, 'store']);
Route::get('/show/opjasa/{kategori}', [OperasionalTreatController::class, 'index']);

//PENJUALAN TREATMENT
Route::get('/penjualan', [PenjualantreatmentController::class, 'index']);

//OPERASIONAL JASA
Route::post('/save/operasionaltreat', [OperasionalController::class, 'store']);
Route::get('/show/opjasa/{kategori}', [OperasionalController::class, 'index']);
// Route::get('/operasional/{id}', [OperasionalController::class, 'index']);
// Route::post('/operasional/store/jasa', [OperasionalController::class, 'store']);

// PRODUK
Route::get('/produk/{kodegrup}', [ProdukController::class, 'load']);
Route::post('/produk/save', [ProdukController::class, 'simpan']);
Route::put('/update/barang/{id}', [ProdukController::class, 'update']);
Route::delete('/barang/delete/{id}', [ProdukController::class, 'delete']);
Route::get('/barang/cetak/{kodegrup}', [ProdukController::class, 'print']);
Route::get('/barang/excel/{kodegrup}', [ProdukController::class, 'excel']);
Route::get('/barang/pdf/{kodegrup}', [ProdukController::class, 'pdf']);

// PEGAWAI
Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::get('/pegawai/{id}', [PegawaiController::class, 'show']);
Route::put('/pegawai/{id}', [PegawaiController::class, 'update']);
Route::post('/pegawai', [PegawaiController::class, 'store']);
Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy']);
// customer
Route::post('pelanggan/store', [PelangganController::class, 'store']);
Route::get('pelanggan/index', [PelangganController::class, 'index']);
Route::delete('pelanggan/delete/{id}', [PelangganController::class, 'destroy'])->name('destroy');
Route::put('pelanggan/update/{id}', [PelangganController::class, 'update']);
Route::get('pelanggan/cetak', [PelangganController::class, 'cetak']);
Route::get('pelanggan/cetakpdf', [PelangganController::class, 'cetakpdf'])->name('cetakpdf');
Route::get('pelanggan/cetakexel', [PelangganController::class, 'cetakexel'])->name('cetakexel');
//DATA DOKTER TERAPIS
Route::post('dokterasisten/store', [DokterasistenController::class, 'store']);
Route::get('dokterasisten/index', [DokterasistenController::class, 'index']);
Route::put('dokterasisten/update/{id}', [DokterasistenController::class, 'update']);
Route::delete('dokterasisten/delete/{id}', [DokterasistenController::class, 'destroy']);
Route::get('dokterasisten/cetak', [DokterasistenController::class, 'cetak']);
Route::get('dokterasisten/cetakpdf', [DokterasistenController::class, 'cetakpdf']);
Route::get('dokterasisten/cetakexel', [DokterasistenController::class, 'cetakexel']);
// DATA MEDIS
Route::get('damed/index', [DamedController::class, 'index']);
Route::post('damed/store', [DamedController::class, 'store']);
Route::delete('damed/delete/{id}', [DamedController::class, 'destroy']);
Route::put('damed/update/{id}', [DamedController::class, 'update']);
Route::get('damed/cetak', [DamedController::class, 'cetak']);
Route::get('damed/cetakpdf', [DamedController::class, 'cetakpdf']);
Route::get('damed/cetakexel', [DamedController::class, 'cetakexel']);
// KOMISI
Route::post('komisi/store', [KomisiController::class, 'store']);
Route::get('komisi/index', [KomisiController::class, 'index']);
Route::delete('komisi/delete/{id}', [KomisiController::class, 'destroy']);
Route::put('komisi/update/{id}', [KomisiController::class, 'update']);
// FAKTUR
// Route::get('pelanggan/get', [FakturController::class, 'getpelanggan']);
Route::get('pelanggan/get/{id}', [FakturController::class, 'getnamapelanggan']);
Route::get('barang/get/{id}', [FakturController::class, 'getkodebarang']);
Route::get('barang/get/{id}', [FakturController::class, 'getkodebarang']);
Route::get('nofaktur/get', [FakturController::class, 'getnofaktur']);
Route::get('getdate/get', [FakturController::class, 'getdate']);

// Route::post('faktur/insert', 'FakturController@insertdata');
Route::post('faktur/insertitem', [FakturController::class, 'insertitem']);
Route::get('faktur/cetak/{id}', [FakturController::class, 'cetak']);
Route::get('faktur/getallcust', [FakturController::class, 'getallcust']);
Route::get('faktur/getallbarang', [FakturController::class, 'getallbrg']);
// REKAM MEDIS
Route::get('rekammedis/getcust/{id}', [RekamMedisController::class, 'getcust']);
Route::get('rekammedis/getdate', [RekamMedisController::class, 'getdate']);
Route::get('rekammedis/getinvoice/{id}', [RekamMedisController::class, 'getinvoice']);
Route::post('rekammedis/store', [RekamMedisController::class, 'store']);
Route::get('rekammedis/getallcust', [RekamMedisController::class, 'getallcust']);
// paket produks
Route::get('/paket', [PaketController::class, 'index']);
Route::get('/pack', [PaketController::class, 'indexpack']);
Route::post('/pack/save', [PaketController::class, 'store']);
Route::post('/item/save', [PaketController::class, 'tambahitem']);
Route::put('/update/pack/{id}', [PaketController::class, 'update']);
//DASHBOARD INTERFACE
Route::get('/dashboard/getjumlahbrgb', [DashboardController::class, 'getjumlahbrgb']);
Route::get('/dashboard/getjumlahbrgm', [DashboardController::class, 'getjumlahbrgm']);
Route::get('/dashboard/getjumlahbrgpp', [DashboardController::class, 'getjumlahbrgpp']);
Route::get('/dashboard/getjumlahbrgt', [DashboardController::class, 'getjumlahbrgt']);
Route::get('/dashboard/getpenjualan1', [DashboardController::class, 'getpenjualan1']);
Route::get('/dashboard/getpenjualan2', [DashboardController::class, 'getpenjualan2']);
Route::get('/dashboard/getpenjualan3', [DashboardController::class, 'getpenjualan3']);
Route::get('/dashboard/getpenjualan4', [DashboardController::class, 'getpenjualan4']);
Route::get('/dashboard/getpenjualan5', [DashboardController::class, 'getpenjualan5']);
//pemasok
Route::get('/pemasoks/load', [PemasokController::class, 'load']);
Route::post('/pemasoks/save', [PemasokController::class, 'save']);
Route::put('/pemasoks/update/{id}', [PemasokController::class, 'update']);
Route::delete('/pemasoks/delete/{id}', [PemasokController::class, 'delete']);
Route::get('/pemasok/print', [PemasokController::class, 'cetak']);
Route::get('/pemasok/pdf', [PemasokController::class, 'pdf']);
Route::get('/pemasok/excel', [PemasokController::class, 'excel']);
//operasional barang
Route::get('/operasionals/index/{id}', [OperasionalBarangController::class, 'index']);
Route::post('/operasionals/save', [OperasionalBarangController::class, 'save']);
//penjualan medis
Route::get('/produks/index', [PenjualanMedisController::class, 'index']);
Route::get('/penjualmedis/print', [PenjualanMedisController::class, 'print']);
Route::get('/penjualmedis/pdf', [PenjualanMedisController::class, 'pdf']);
Route::get('/penjualmedis/excel', [PenjualanMedisController::class, 'excel']);

// pembelian
Route::get('/loadpemasok', [CatatanPembelianController::class, 'loadpemasok']);
Route::get('/loadfilterproduk', [CatatanPembelianController::class, 'loadproduk']);
Route::post('/simpan/pembelian', [CatatanPembelianController::class, 'simpan']);
Route::post('/simpan/pembeliangrdttl', [CatatanPembelianController::class, 'simpangrdttl']);
Route::get('/loadpembelian', [CatatanPembelianController::class, 'loadpembelian']);
