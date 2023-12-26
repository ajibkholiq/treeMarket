<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "no_trans",
        "customer_id",
        "tgl",
        "status",
        "note"
    ];

    public static function customer (){
        return $this->belongsTo(cutomer::class);
    }

    public function detail(){
        return $this->hasMany(orderDetail::class);
    }
}
