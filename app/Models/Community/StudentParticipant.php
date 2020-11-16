<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ignug\Catalogue;
use App\Models\Authentication\User;
class StudentParticipant extends Model
{
    //
    protected $connection = 'pgsql-community';

    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }
    public function funtion(){
        return $this->belongsTo(Catalogue::class,'funtion_id');
    }
}
