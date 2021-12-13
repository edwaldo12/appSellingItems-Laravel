<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailContainer extends Model
{
    use HasFactory;

    public function container()
    {
        return $this->belongsTo(Container::class, 'detail_containers', 'id');
    }
}
