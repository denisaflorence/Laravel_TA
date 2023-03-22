<?php

namespace App\Http\Controllers;
use Session;
use Alert;
use Mail;
use DB;
use PDF;
use DataTables;
use App\Models\Produk;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Reseller;
use App\Models\StockOpname;
use App\Models\Admin;
use App\Models\Grade;

use Carbon\Carbon;



use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    public function add_so(){
        $id = DB::select('CALL ID_stockopname');
        $produk = Produk::all();
        
        return view('Stok_Opname.tambah', compact('id','produk'));
    }

    public function insert_so(Request $request){
        // dd($request->all());
        // dd($email);
        $id = Session::get('login');
        $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->toDateString();
        $satuan = 'pcs';
        StockOpname::create([
            'opname_id'=>$request->input('opname_id'),
            'admin_id'=>'owner',
            'produk_id'=>$request->input('produk'),
            'satuan_id'=>$satuan,
            'jumlah_sistem'=>$request->input('jumlah_sistem'),
            'jumlah_hitung'=>$request->input('jumlah_hitung'),
            'perbedaan'=>$request->input('perbedaan'),
            'alasan'=>$request->input('alasan'),
            'tanggal'=>$tanggal
            ]);

        return redirect('/stockopname');
    }

    public function combo_box_tahun(){
        $tahun = DB::select('SELECT EXTRACT(YEAR FROM tanggal) AS year
        FROM stock_opname
        GROUP BY year
        ');
        return view('Stok_Opname.laporan_tahun',compact('tahun'));
    }


    public function preview_laporan_tahun(){
    

        $year = $_POST['year'];
        $so = DB::select('SELECT opname_id, tanggal, p.nama_produk, p.satuan_id, jumlah_sistem, jumlah_hitung, perbedaan, alasan
        FROM stock_opname so, produk p
        WHERE EXTRACT(YEAR FROM tanggal) = '.$year.' AND so.produk_id = p.produk_id
        ');

        
        // dd($so);
       
        ini_set('max_execution_time', 300);
       return view('Stok_Opname.preview_laporan_so', compact('so','year') );
       
      

       

        // return view('Barang.Keluar.laporan');
    }


    public function laporan_tahun(){
    

        $year = $_POST['year'];



        $so = DB::select('SELECT opname_id, tanggal, p.nama_produk, p.satuan_id, jumlah_sistem, jumlah_hitung, perbedaan, alasan
        FROM stock_opname so, produk p
        WHERE EXTRACT(YEAR FROM tanggal) = '.$year.' AND so.produk_id = p.produk_id
        ');

        
        // dd($so);
       
        ini_set('max_execution_time', 300);
        $pdf = PDF::loadview('Stok_Opname.laporan_so_pdf', compact('so','year') );
        return $pdf->stream();
      

       

        // return view('Barang.Keluar.laporan');
    }

}
