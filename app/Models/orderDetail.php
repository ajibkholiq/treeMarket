<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        "order_id",
        "nama",
        "gambar",
        "harga",
        "jumlah"
    ];

    public function order(){
        return $this->belongsTo(order::class);
    }


}
