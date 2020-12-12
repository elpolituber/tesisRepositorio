<?php

namespace App\Models\Community;

use App\Models\Ignug\Catalogue;
use App\Models\Ignug\State;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusDeletedTrait;
use OwenIt\Auditing\Contracts\Auditable;
class Objetive extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    use StatusActiveTrait;
    use StatusDeletedTrait;

    protected $connection = 'pgsql-community';
    protected $table='community.objectives';
    use \OwenIt\Auditing\Auditable;
    protected $casts=[
        'means_verification'=>'array',
    ];
    
    public function state(){
        return $this->belongsTo(State::class);
    }

    public function type(){
        return $this->belongsTo(Catalogue::class,'type');
    }
    public function parent() 
    { 
     return $this->belongsTo(Objetive::class,'children')->where('children',null)->with('parent'); 
    }
    public function children(){
        return $this->hasMany(Objetive::class,'children')->with('children');
    }
   
}
