<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendingItem extends Model
{
    use HasFactory;

    public function detail_picture()
    {
        return $this->hasMany(DetailSendingItem::class, "detail_id", "id");
    }

    public function good_items()
    {
        return $this->belongsTo(Good::class, "good_id", "id");
    }
}
