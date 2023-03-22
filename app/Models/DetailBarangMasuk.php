<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangMasuk extends Model
{
    use HasFactory;
    protected $table = "detail_barang_masuk";
    protected $fillable = [
        "invoice_id",
        "produk_id",
        "jumlah",
        "satuan_id",
        "harga"
        
    ];

    public function produk()
    {
    	return $this->belongsTo('App\Models\Produk', 'produk_id');
   
    }

}
