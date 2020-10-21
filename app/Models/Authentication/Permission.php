<?php

namespace App\Models\Authentication;

use App\Models\Ignug\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql-authentication';

    const CREATE_ACTION = 'CREATE';
    const UPDATE_ACTION = 'UPDATE';
    const DELETE_ACTION = 'DELETE';
    const SELECT_ACTION = 'SELECT';

    protected $casts = [
        'actions' => 'array',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
