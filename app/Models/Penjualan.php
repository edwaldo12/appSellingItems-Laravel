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
        return $this->detail_penjualan->reduce(function ($a, $b) {
            return $a + $b->sub_total;
        }, 0);
    }
}
