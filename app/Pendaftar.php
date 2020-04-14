<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendaftar extends Model
{
    use SoftDeletes;

    protected $table = "pendaftar";

    protected $fillable = [
        'nama_pendaftar', 'jenis_kelamin', 'alamat', 'foto', 'username', 'password', 'status'
    ];

    protected $hidden = [
        'password'
    ];

    // public function nilai()
    // {
    //     return $this->hasMany('App\Nilai');
    // }

    // public function temp_detail()
    // {
    //     return $this->hasMany('App\TempDetail');
    // }

    // public function detail_komentar()
    // {
    //     return $this->hasMany('App\DetailKomentar');
    // }
 
    protected $dates = ['deleted_at'];
}
