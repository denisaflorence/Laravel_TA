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
use App\Models\Grade;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ResellerController extends Controller
{
    public function addreseller(){
        $reseller_id =DB::select('CALL ID_reseller');
        $grade = DB::table('grade')
        ->select('*')
        ->groupBy('grade_id')
        ->get();
        // dd($grade);
        return view('Reseller.tambah', compact('grade','reseller_id'));
    }

    public function insert_reseller(Request $request){
        // $tanggal = Carbon::parse($request->tanggal)->toDateString();
        $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->toDateString();
        Reseller::create([
            'reseller_id'=>$request->input('reseller_id'),
            'nama_reseller'=>$request->input('nama_reseller'),
            'alamat'=>$request->input('alamat'),
            'total_kutus'=>$request->input('total_kutus'),
            'tanggal_kutus'=>$tanggal,
            'grade_id'=>$request->input('grade'),
            ]);

        return redirect('/reseller');

    }


    public function reseller_edit($id){
        $res = Reseller::find($id);
        $grade = DB::table('grade')
        ->select('*')
        ->groupBy('grade_id')
        ->get();
        return view('Reseller.edit', compact('res','grade'));
    }

    public function reseller_update(Request $request){
        // dd($request->all());
        $id = $_POST['reseller_id'];
       
        Reseller::where('reseller_id',$id)->update([
            'nama_reseller'=> $request->input('nama_reseller'), 
            'alamat'=>$request->input('alamat'),
            'grade_id'=>$request->input('grade')

        ]);

        return redirect('/reseller/edit/'.$id);
    }

    
    public function destroy_reseller($id)
    {
        Reseller::where('reseller_id',$id)->delete();
      
        // kalau pakai restore dibalikin
        return redirect('/reseller');
        
    }
}
