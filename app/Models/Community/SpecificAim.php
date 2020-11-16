<?php

namespace App\Models\Community;

use App\Models\Ignug\Catalogue;
use Illuminate\Database\Eloquent\Model;

class SpecificAim extends Model
{
    //use \OwenIt\Auditing\Auditable;
    //
    
    protected $connection = 'pgsql-community';
    protected $casts=[
        'verifications'=>'array',
    ];

    public function type(){
        return $this->belongsTo(Catalogue::class,'type_id');
    }
    public function parent_code(){
        return $this->belongsTo(SpecificAim::class,'parent_code_id');
    }
    
}
