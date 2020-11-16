<?php

namespace App\Models\Community;

use App\Models\Ignug\Catalogue;
use Illuminate\Database\Eloquent\Model;

class ProjectActivities extends Model
{
   // use \OwenIt\Auditing\Auditable;
    //
    protected $connection = 'pgsql-community';

    public function type(){
        return $this->belongsTo(Catalogue::class,'type_id');
    }
}
