<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'order';

    use SoftDeletes;

    protected $fillable = ['id_pendaftar', 'total_tagihan', 'tanggal_order', 'status_kursus'];

    // public function kursus()
    // {
    //     return $this->belongsTo(Kursus::class, 'id', 'id_kategori');
    // }

    public function order_detail()
    {
        return $this->belongsTo(OrderDetail::class, 'id', 'id_order');
    }

    protected $dates = ['deleted_at'];
}
