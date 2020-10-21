<?php

namespace App\Models\Attendance;

use App\Models\Ignug\Teacher;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Ignug\State;
use App\Models\Ignug\Catalogue;

class Attendance extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql-attendance';
    protected $fillable = [
        'date'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d'
    ];

    public function attendanceable()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'attendanceable_id')->with('user');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function workdays()
    {
        return $this->hasMany(Workday::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
