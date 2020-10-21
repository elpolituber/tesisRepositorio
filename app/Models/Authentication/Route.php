<?php

namespace App\Models\Authentication;

use App\Models\Ignug\Catalogue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    public function module()
    {
        return $this->belongsTo(Catalogue::class, 'module_id');
    }

    public function children()
    {
        return $this->hasMany(Route::class, 'parent_id');
    }
}
