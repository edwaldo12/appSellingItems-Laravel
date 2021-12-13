<?php

namespace App\Models;

use App\Http\Controllers\ContainerController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    public function detail_container()
    {
        return $this->hasMany(DetailContainer::class, "detail_containers", 'id');
    }
}
