<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian';
    protected $appends = ['total'];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "id_supplier", "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function detail_pembelian()
    {
        return $this->hasMany(Detail_Pembelian::class, "id_pembelian", "id");
    }

    public function getTotalAttribute()
    {
        return $this->detail_pembelian->reduce(function ($a, $b) {
            return $a + $b->sub_total;
        }, 0);
    }
}
