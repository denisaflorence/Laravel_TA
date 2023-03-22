<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
class Reseller extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'reseller_id';
    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
    protected $table = "reseller";
    protected $fillable = [
        "reseller_id",
        "nama_reseller",
        "alamat",
        "total_kutus",
        "tanggal_kutus",
        "grade_id",
        "status_del"
    ];

    public function grade()
    {
    	return $this->belongsTo('App\Models\Grade', 'grade_id');
   
    }
}
