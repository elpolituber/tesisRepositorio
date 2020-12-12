<?php

namespace App\Models\Community;

use App\Models\Ignug\Catalogue;
use App\Models\Ignug\State;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusDeletedTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Activities extends Model implements Auditable
{
   use \OwenIt\Auditing\Auditable;
   use StatusActiveTrait;
    use StatusDeletedTrait;
    //
    protected $connection = 'pgsql-community';
    protected $table='community.activities';
    use \OwenIt\Auditing\Auditable;

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function type(){
        return $this->belongsTo(Catalogue::class,'type_id');
    }
    public function project(){
        return $this->belongsTo(Project::class,'type_id');
    }
}
