<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";

    public function barang_masuk()
    {
        return $this->hasMany(BarangMasuk::class, "id_barang", "id");
    }

    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class, "id_barang", "id");
    }
}
