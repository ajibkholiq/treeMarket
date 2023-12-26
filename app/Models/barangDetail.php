<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "barang_id",
        "type",
        "nama_type",
    ];

    public function barang(){
        return $this->belongsTo(barang::class);
    }
}
