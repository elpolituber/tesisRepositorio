<?php

namespace App\Models\Authentication;

use App\Models\Ignug\Catalogue;
use App\Models\Ignug\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql-authentication';
    //rotected $table='pgsql.roles';
    const ADMINISTRATOR = 'admin';
    const TEACHER = 'teacher';

    protected $fillable = [
        'code',
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function system()
    {
        return $this->belongsTo(Catalogue::class, 'system_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
