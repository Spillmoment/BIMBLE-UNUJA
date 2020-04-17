<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = 'tutor';

    protected $fillable = ['nama_tutor', 'alamat', 'email', 'foto', 'username', 'password', 'status', 'keahlian'];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id', 'id_tutor');
    }
}
