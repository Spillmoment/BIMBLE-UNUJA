<?php

namespace App;

use App\Http\Requests\KursusRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kursus extends Model
{
    protected $table = 'kursus';

    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kategori', 'id_tutor', 'nama_kursus', 'slug', 'gambar_kursus', 'biaya_kursus', 'diskon_kursus', 'lama_kursus',
        'latitude', 'longitude', 'keterangan'
    ];


    use SoftDeletes;


    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'id', 'id_kategori');
    }

    public function tutor()
    {
        return $this->hasMany(Tutor::class, 'id', 'id_tutor');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'kursus_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id', 'id_kursus');
    }
}
