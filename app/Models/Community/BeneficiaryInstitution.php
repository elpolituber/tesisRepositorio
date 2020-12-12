<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ignug\State;
use App\Models\Ignug\Address;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusDeletedTrait;
class BeneficiaryInstitution extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use StatusActiveTrait;
    use StatusDeletedTrait;
    protected $connection = 'pgsql-community';
    protected $table='community.beneficiary_institutions';
    protected $fillable = [
        "id",
        "state_id",
        "logo",
        "ruc",
        "name",
        "address",
        "legal_representative_name",
        "legal_representative_lastname",
        "legal_representative_identification",
        "function",
    ];
     //utilizacion para el tipo json 
      protected $casts=[
    //     'indirect_beneficiaries'=>'array',
    //     'direct_beneficiaries'=>'array',
     ];
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function logo()
    {
        return $this->hasOne(Image::class);
    }
    public function project(){
        return $this->hasMany(Career::class,'project_id');
    }
    public function address(){
        return $this->belongsTo(Address::class,'address');
    }
    public function files()
    {
        return $this->morphMany(Image::class, 'fileable');
    }

}
