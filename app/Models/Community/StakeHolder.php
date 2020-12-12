<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ignug\State;
use App\Models\Ignug\Catalogue;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusDeletedTrait;
use OwenIt\Auditing\Contracts\Auditable;

class StakeHolder extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    use StatusActiveTrait;
    use StatusDeletedTrait;

    protected $connection = 'pgsql-community';
    protected $table='community.stake_holders'; 
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function type(){
        return $this->belongsTo(Catalogue::class,'type');
    }
}
