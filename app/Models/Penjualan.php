<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $appends = ['total'];

    public function pelanggan()
    {
        return $this->belongsTo(Customer::class, "pelanggan_id", "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function detail_penjualan()
    {
        return $this->hasMany(Detail_Penjualan::class, 'penjualan_id', 'id');
    }
    public function getTotalAttribute()
    {
        $detail_penjualan = $this->with(['detail_penjualan.barang'])->find($this->id)->detail_penjualan;
        return $detail_penjualan->reduce(function ($a, $b) {
            return $a + ($b['jumlah'] * $b['barang']['harga']);
        }, 0);
    }
}
