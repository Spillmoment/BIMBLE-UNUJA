<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    protected $table = 'order';

    use SoftDeletes;

    protected $fillable = [
        'no_orders', 'tanggal_order'
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'id','id_order');
    }
}
