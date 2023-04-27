<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
use DB;

class Admin extends Model
{
    use HasFactory;
    protected $primaryKey = 'admin_id';
    public $incrementing = false;

    protected $keyType = 'string';
    protected $table = "admin";
    protected $fillable = [
        "admin_id",
        "password",
        "nama_admin",
        "gaji",
        "alamat",
        "nomor_telepon",
        "email",
        "akses_id",
        "status_del",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function isExist($data){
        $cmd = "SELECT count(*) is_exist 
                FROM admin 
                WHERE admin_id=:username AND password=:password;";

        $res = DB::select($cmd,$data);
        if($res[0]->is_exist == 1){
            return true;
        }
        return false;

        if(isset($res) && count($res) > 0){
            return $res;
        }
        return null;
    }
}
