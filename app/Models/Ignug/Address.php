<?php

namespace App\Models\Ignug;

use App\Models\Community\BeneficiaryInstitution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $connection = 'pgsql-ignug';
    protected $table='ignug.address';
    protected $fillable = [
        'latitud',
        'longitud',
        'main_street',
        'secondary_street',
        'number',
        'post_code',
    ];

    public function setMainStreetAttribute($value)
    {
        $this->attributes['main_street'] = strtoupper($value);
    }

    public function setSecondaryStreetAttribute($value)
    {
        $this->attributes['secondary_street'] = strtoupper($value);
    }

    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = strtoupper($value);
    }

    public function setPostCodeAttribute($value)
    {
        $this->attributes['post_code'] = strtoupper($value);
    }
    // public function BeneficiaryInstitution(){
    //     return $this->hasMany(BeneficiaryInstitution::class);
    // }

}
