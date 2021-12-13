<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;
    protected $table = "goods";

    public function good_details()
    {
        return $this->hasMany(DetailGood::class, "detail_id", "id");
    }
}
