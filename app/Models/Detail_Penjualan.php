<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Penjualan extends Model
{
    use HasFactory;
    protected $table = 'detail_penjualan';
    protected $appends = ['sub_total'];

    public function pelanggan()
    {
        return $this->hasMany(Penjualan::class, "penjualan_id", "id");
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, "barang_id", "id");
    }

    public function getSubTotalAttribute()
    {
        return $this->barang->harga_jual * $this->jumlah;
    }
}
