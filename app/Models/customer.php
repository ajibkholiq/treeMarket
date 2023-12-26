<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "no_plg",
        "nama",
        "no_hp",
        "alamat"
    ];

    public function orders() {
        return $this->hasMany(order::class);
    }
}
