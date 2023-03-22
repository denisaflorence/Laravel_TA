<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class BarangKeluar extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $primaryKey = 'nota_id';
    public $incrementing = false;
    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
    protected $dates = ['deleted_at'];
    protected $table = "barang_keluar";
    protected $fillable = [
        "nota_id",
        "admin_id",
        "reseller_id",
        "tanggal",
        "total_harga_penjualan",
        "sudah_dibayar",
        "belum_dibayar",
        "jumlah_kutus",
        "updated_at"
        
    ];

    public function reseller()
    {
    	return $this->belongsTo('App\Models\Reseller', 'reseller_id');
   
    }

    public function admin()
    {
    	return $this->belongsTo('App\Models\Admin', 'admin_id');
   
    }
}
