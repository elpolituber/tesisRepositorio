<?php

namespace App\Models\Ignug;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class school_period extends Model
{
    use HasFactory;
    protected $connection = 'pgsql-ignug';
}
