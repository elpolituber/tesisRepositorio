<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ignug\Catalogue;
use App\Models\Ignug\State;
use App\Models\Ignug\school_period;
use App\Models\Community\StakeHolder;
use App\Models\Ignug\Career;
use App\Models\Community\BeneficiaryInstitution;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusDeletedTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Project extends Model implements Auditable
{
    use StatusActiveTrait;
    use StatusDeletedTrait;
    use \OwenIt\Auditing\Auditable;
    protected $connection = 'pgsql-community';
    protected $table="community.projects";
    
    //utilizacion para el tipo json 
    protected $casts=[
        'observations'=>'array',
        'cycle'=>'array',
        'bibliografia'=>'array',
        'indirect_beneficiaries'=>'array',
        'direct_beneficiaries'=>'array',
        
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
    public function school_period(){
        return $this->belongsTo(school_period::class,'school_period');
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
    public function objetive(){
        return $this->hasMany(Objetive::class)->where('children',null);
    }
  
}
