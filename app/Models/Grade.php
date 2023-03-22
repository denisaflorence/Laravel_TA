<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Grade extends Model
{
    use HasFactory;
    protected $primaryKey = 'grade_id';
    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
    protected $table = "grade";
    protected $fillable = [
        "grade_id",
        "jenis_grade",
        "produk_id",
        "potongan",
        "status_del"
    ];


}
