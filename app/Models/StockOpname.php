<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class StockOpname extends Model
{
    use HasFactory;
    protected $primaryKey = 'opname_id';
    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
    protected $table = "stock_opname";
    protected $fillable = [
        "opname_id",
        "satuan_id",
        "admin_id",
        "produk_id",
        "jumlah_sistem",
        "jumlah_hitung",
        "perbedaan",
        "alasan",
        "tanggal",
        "created_at",
        "updated_at"
    ];

    public function admin()
    {
    	return $this->belongsTo('App\Models\Admin', 'admin_id');
   
    }

    public function produk()
    {
    	return $this->belongsTo('App\Models\Produk', 'produk_id');
   
    }
}
