<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $primaryKey = "invoice_id";
    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
    protected $table = "barang_masuk";
    protected $fillable = [
        "invoice_id",
        "total_harga",
        "tanggal"
        
    ];
}
