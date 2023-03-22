<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    //     return view('welcome');
    // });
Route::get('/', 'App\Http\Controllers\AwalController@login');
Route::get('/home', 'App\Http\Controllers\AwalController@home');
Route::get('/home/json', 'App\Http\Controllers\AwalController@json');
// LOGIN
Route::get('/login', 'App\Http\Controllers\AwalController@login');
Route::post('/authenticate','App\Http\Controllers\AwalController@authentication');
Route::post('/forgotpass','App\Http\Controllers\AwalController@forgot_pass');
// BARANG MASUK
Route::get('/barangmasuk', 'App\Http\Controllers\AwalController@incoming');
Route::get('/barangmasuk/json', 'App\Http\Controllers\AwalController@json');

Route::get('/barangmasuk/edit/{id}', 'App\Http\Controllers\BarangMasukController@edit');
// CREATE BARANG MASUK
Route::get('/addproduk', 'App\Http\Controllers\BarangMasukController@addproduk');
Route::post('/insertincoming', 'App\Http\Controllers\BarangMasukController@insert_incoming');
Route::get('/barangmasuk/detail/{id}', 'App\Http\Controllers\BarangMasukController@detail_barangmasuk');
// Route::get('/barangmasuk/cetak_pdf/{id}', 'App\Http\Controllers\BarangMasukController@cetak_pdf');
Route::get('/laporan/bulan', 'App\Http\Controllers\BarangMasukController@combo_box');
Route::post('/laporan/masuk', 'App\Http\Controllers\BarangMasukController@laporan_bulan');
Route::post('/preview/laporan/masuk', 'App\Http\Controllers\BarangMasukController@preview_laporan_bulan');
Route::get('/laporan/tahun', 'App\Http\Controllers\BarangMasukController@combo_box_tahun');
Route::post('/preview/laporan/tahun/cetak', 'App\Http\Controllers\BarangMasukController@preview_laporan_tahun');
Route::post('/laporan/tahun/cetak', 'App\Http\Controllers\BarangMasukController@laporan_tahun');


// READ BARANG KELUAR
Route::get('/barangkeluar', 'App\Http\Controllers\AwalController@exit');
Route::get('/barangkeluar/exit_json', 'App\Http\Controllers\AwalController@exit_json');
// UPDATE BARANG KELUAR
Route::get('/barangkeluar/edit/{id}', 'App\Http\Controllers\BarangKeluarController@edit');
Route::post('/barangkeluar/edit/update', 'App\Http\Controllers\BarangKeluarController@update_exit');
// CREATE BARANG KELUAR
Route::get('/addexit', 'App\Http\Controllers\BarangKeluarController@addexit');
Route::post('/calexit', 'App\Http\Controllers\BarangKeluarController@calexit');
Route::post('/insertexit', 'App\Http\Controllers\BarangKeluarController@insert_exit');
Route::get('/barangkeluar/detail/{id}', 'App\Http\Controllers\BarangKeluarController@detailbarangkeluar');
Route::get('/barangkeluar/cetak_pdf/{id}', 'App\Http\Controllers\BarangKeluarController@cetak_pdf');
// DELETE BARANG KELUAR
Route::get('/barangkeluar/destroy/{id}', 'App\Http\Controllers\BarangKeluarController@destroy');
// LAPORAN BARANG KELUAR
Route::get('/laporan/bln', 'App\Http\Controllers\BarangKeluarController@combo_box');
Route::get('/laporan/thn', 'App\Http\Controllers\BarangKeluarController@combo_box_tahun');
Route::post('preview/laporan/keluar', 'App\Http\Controllers\BarangKeluarController@preview_laporan_bulan');
Route::post('/laporan/keluar', 'App\Http\Controllers\BarangKeluarController@laporan_bulan');
Route::post('/preview/laporan/thn/cetak', 'App\Http\Controllers\BarangKeluarController@preview_laporan_tahun');
Route::post('/laporan/thn/cetak', 'App\Http\Controllers\BarangKeluarController@laporan_tahun');





// PRODUK
// EDIT PRODUK
Route::get('/produk/edit/{id}', 'App\Http\Controllers\ProdukController@produkedit');
Route::post('/produk/update', 'App\Http\Controllers\ProdukController@update_produk');




Route::get('/produk', 'App\Http\Controllers\AwalController@produk');
Route::get('/produk/produk_json', 'App\Http\Controllers\AwalController@produk_json');

Route::get('/reseller', 'App\Http\Controllers\AwalController@reseller');
Route::get('/reseller/reseller_json', 'App\Http\Controllers\AwalController@reseller_json');
Route::get('/reseller/edit/{id}', 'App\Http\Controllers\ResellerController@reseller_edit');
Route::post('/reseller/update', 'App\Http\Controllers\ResellerController@reseller_update');
Route::get('/reseller/add', 'App\Http\Controllers\ResellerController@addreseller');
Route::post('/reseller/insert', 'App\Http\Controllers\ResellerController@insert_reseller');
Route::get('/reseller/destroy/{id}', 'App\Http\Controllers\ResellerController@destroy_reseller');



Route::get('/stockopname', 'App\Http\Controllers\AwalController@sopname');
Route::get('/stockopname/sopname_json', 'App\Http\Controllers\AwalController@sopname_json');
Route::get('/stockopname/add', 'App\Http\Controllers\StockOpnameController@add_so');
Route::post('/stockopname/insert', 'App\Http\Controllers\StockOpnameController@insert_so');
Route::get('/stockopname/laporan', 'App\Http\Controllers\StockOpnameController@combo_box_tahun');
Route::post('/stockopname/preview/laporan', 'App\Http\Controllers\StockOpnameController@preview_laporan_tahun');
Route::post('/stockopname/cetak/laporan', 'App\Http\Controllers\StockOpnameController@laporan_tahun');

Route::get('/admin', 'App\Http\Controllers\AwalController@admin');
Route::get('/admin/admin_json', 'App\Http\Controllers\AwalController@admin_json');
Route::get('/admin/edit/{id}', 'App\Http\Controllers\AdminController@admin_edit');
Route::post('/admin/update', 'App\Http\Controllers\AdminController@admin_update');
Route::get('/addadmin', 'App\Http\Controllers\AdminController@add_admin');
Route::post('/insertadmin', 'App\Http\Controllers\AdminController@insert_admin');
Route::get('/admin/destroy/{id}', 'App\Http\Controllers\AdminController@destroy_admin');

// Route::get('/exit2', 'App\Http\Controllers\AwalController@exit2');

Route::get('/profile', 'App\Http\Controllers\AwalController@profile');

Route::get('/login', 'App\Http\Controllers\AwalController@login');



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');







Route::get('/about', 'App\Http\Controllers\AwalController@about');
Route::get('/logout', 'App\Http\Controllers\AwalController@logout');

// Route::get('/deleteincoming', 'App\Http\Controllers\AwalController@deleteincoming');





