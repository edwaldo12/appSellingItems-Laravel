<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSendingItem extends Model
{
    use HasFactory;
    // protected $appends = ['subtotal'];

    public function sending_items()
    {
        return $this->belongsTo(SendingItem::class, "detail_id", "id");
    }

    // public function getSubtotalAttribute()
    // {
    //     return $this->qty * $this->good()->first()->price;
    // }

    // public function container()
    // {
    //     return $this->hasMany(ContainerController::class, "container_id");
    // }

    // public function good()
    // {
    //     return $this->hasMany(Good::class, "good_id");
    // }
}
