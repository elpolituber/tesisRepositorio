<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ignug\Catalogue;
use App\Models\Ignug\State;
use App\Models\Community\StakeHolder;
use App\Models\Ignug\Career;
use App\Models\Community\BeneficiaryInstitution;
use App\Models\Authentication\User;
use App\Models\Community\Authorities;
//use OwenIt\Auditing\Contracts\Auditable;

class Project extends Model
{
    //use \OwenIt\Auditing\Auditable;
   // protected $table="vinculacion.projects";
    protected $connection = 'pgsql-community';
    //utilizacion para el tipo json 
    protected $casts=[
        'cycle'=>'array',
        'bibliografia'=>'array',
        //
    ];
    //
    public function BeneficiaryInstitution(){
        return $this->belongsTo(BeneficiaryInstitution::class,'beneficiary_institution');
    }
    public function career(){
        return $this->belongsTo(Career::class,'career_id');
    }
    public function status(){
        return $this->belongsTo(Catalogue::class,'status_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    //revisar
    public function location(){
        return $this->belongsTo(Catalogue::class,'location_id');
    }
    public function frequency_activities(){
        return $this->belongsTo(Catalogue::class,'frequency_activities');
    }
   
    public function participant(){
        return $this->hasMany(Participant::class);
    }
    public function stake_holder(){
        return $this->hasMany(StakeHolder::class);
    }
    public function activities(){
        return $this->hasMany(Activities::class);
    }
  
}
