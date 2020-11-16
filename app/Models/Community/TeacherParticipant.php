<?php

namespace App\Models\Community;
use App\Models\Ignug\Catalogue;
use App\Models\Authentication\User;
use Illuminate\Database\Eloquent\Model;

class TeacherParticipant extends Model
{
    //
    protected $connection = 'pgsql-community';

    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id');
    }
    public function funtion(){
        return $this->belongsTo(Catalogue::class,'funtion_id');
    }
}
