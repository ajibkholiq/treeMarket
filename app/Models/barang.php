<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $fillable =[
        "uuid",
        "kategori_id",
        "nama",
        "gambar",
        "jumlah",
        "harga",
        "deskripsi"
    ];

    public function kategori(){
        return $this->belongsTo(kategori::class);
    }

    public function detail(){
        return $this->hasMany(barangDetail::class);
    }

    public function detailOrder(){
        return $this->belongsTo(orderDetail::class);
    }
}
