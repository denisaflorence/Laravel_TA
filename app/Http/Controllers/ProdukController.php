<?php

namespace App\Http\Controllers;
use Session;
use Alert;
use Mail;
use DB;
use DataTables;
use App\Models\Produk;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Reseller;
use App\Models\StockOpname;
use App\Models\Admin;
use Carbon\Carbon;


use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function produkedit($id){

        $produk = Produk::find($id);
        return view('Produk.edit', compact('produk'));
    }

    public function update_produk(Request $request){
        $id = $_POST['produk_id'];
        Produk::where('produk_id',$id)->update([
            'nama_produk'=> $request->input('nama_produk'), 
            'jumlah_stok'=>$request->input('jumlah_stok'), 
            'satuan_id'=>$request->input('satuan'),  
            'harga_modal'=>$request->input('harga_modal'), 
            'harga_jual'=>$request->input('harga_jual')
        ]);
        return redirect('/produk');
    }
}
