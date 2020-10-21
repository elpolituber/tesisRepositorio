<?php

namespace App\Models\Ignug;

use App\Models\Authentication\Role;
use App\Models\Authentication\Route;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Catalogue extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql-ignug'; //cambiar cuando ya se implemente el catalogo
//    protected $connection = 'pgsql-ignug'; //cambiar cuando ya se implemente el catalogo

    const TYPE_SYSTEMS = 'systems';
    const TYPE_MODULES = 'modules';
    const SYSTEM_ATTENDANCE = 'attendance';
    const SYSTEM_CECY = 'cecy';
    const MODULE_ATTENDANCE = 'attendance';
    const MODULE_CECY = 'cecy';

    protected $fillable = [
        'code',
        'name',
        'type',
        'icon'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function parent()
    {
        return $this->belongsTo(Catalogue::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Catalogue::class, 'parent_id');
    }

    public function tasks()
    {
        return $this->hasMany(Catalogue::class, 'parent_id');
    }

    public function routes()
    {
        return $this->hasMany(Route::class, 'module_id');
    }
    public function systems()
    {
        return $this->hasMany(Role::class, 'system_id');
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtolower($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}
