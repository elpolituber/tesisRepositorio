<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ignug\Catalogue;
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
    ];
    //
    public function CharitableInstitution(){
        return $this->belongsTo(CharitableInstitution::class);
    }
    public function status(){
        return $this->belongsTo(Catalogue::class,'status_id');
    }
    public function assigned_line(){
        return $this->belongsTo(Catalogue::class,'assigned_line_id');
    }
    public function fraquency(){
        return $this->belongsTo(Catalogue::class,'fraquency_id');
    }
    public function coordinador_project(){
        return $this->belongsTo(User::class,'coordinador_project_id');
    }
    public function coordinador_vinculacion(){
        return $this->belongsTo(Authorities::class,'coordinador_vinculacion_id');
    }
    public function coordinador(){
        return $this->belongsTo(Authorities::class,'coordinador_id');
    }
    public function rector(){
        return $this->belongsTo(Authorities::class,'rector_id');
    }
    
}
