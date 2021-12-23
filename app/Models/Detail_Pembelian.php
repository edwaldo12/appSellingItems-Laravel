<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Pembelian extends Model
{
    use HasFactory;
    protected $table = 'detail_pembelian';
    protected $appends = ['sub_total'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

    public function getSubTotalAttribute()
    {
        return $this->barang->harga_beli * $this->jumlah;
    }
}
