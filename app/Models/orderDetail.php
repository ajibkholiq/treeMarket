<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        "order_id",
        "barang_id",
        "jumlah"
    ];

    public function order(){
        return $this->belongsTo(order::class);
    }

    public function barang(){
        return $this->hasOne(barang::class);
    }

}
