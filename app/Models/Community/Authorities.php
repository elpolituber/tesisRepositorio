<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ignug\State;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusDeletedTrait;
class Authorities extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use StatusActiveTrait;
    use StatusDeletedTrait;
    protected $connection = 'pgsql-community';
    protected $table='community.authorities';
    public function state(){
        return $this->belongsTo(State::class);
    }
}
