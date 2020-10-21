<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;
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
    ];
    //
}
