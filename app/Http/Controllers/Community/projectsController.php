<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Community\Project;
use App\Models\Community\CharitableInstitution;
use App\Models\Community\SpecificAim;
use App\Models\Community\ProjectActivities;
use App\Models\Community\StudentParticipant;
use App\Models\Community\TeacherParticipant;
use App\Models\Community\Observation;
use App\Models\Ignug\Career;
use App\Models\Ignug\Catalogue;
use App\Models\Ignug\Image;
use Illuminate\Support\Facades\DB;

class projectsController extends Controller
{
  public function show(Request $request){
    $project_env=array();
    //coodinador de vinculacion
    if($request->rol=="coodinador_vinculacion"){
      $project_last=Project::select('id')->get();
      for ($i=0; $i < $project_last->count() ; $i++) { 
        $project=Project::find($project_last[$i])->first();
        $assigned_line=Project::find($project->id)->assigned_line;
        $fraquencyOfActivity=Project::find($project->id)->fraquency;
        $status=Project::find($project->id)->status;
        $coordinador_project=Project::find($project->id)->coordinador_project;
        $coordinador_project=Project::findOrFail($project->id)->coordinador_project;
        $coordinador_vinculacion=Project::findOrFail($project->id)->coordinador_vinculacion;
        $coordinador=Project::findOrFail($project->id)->coordinador_id;
        $rector=Project::findOrFail($project->id)->rector_id;
        $project["assigned_line_id"]=$assigned_line->name;
        $project["fraquency_id"]=$fraquencyOfActivity->name;
        $project["status_id"]=$status->name;
        $project["coordinador_project_id"]=$coordinador_project;
        $project["coordinador_vinculacion_id"]=$coordinador_vinculacion;
        $project["coordinador_id"]=$coordinador;
        $project["rector_id"]=$rector;    
        $project["charitable_institution_id"]=Project::find($project->id)->CharitableInstitution;
        $project["career_id"]=Career::where('careers.id',$project->career_id)
        ->join('catalogues','careers.modality_id','=','catalogues.id')
        ->first(["careers.id","careers.name","catalogues.name as modality"]);
        $project_env[]=$project;
      }
      return $project_env;
    }
    //Profesores
    if($request->rol=="Teacher"){
      $project_last=Project::where("coordinador_project_id",$request->user_id)->get(["id"]);
      for ($i=0; $i < $project_last->count() ; $i++) { 
        $project=Project::find($project_last[$i])->first();
        $assigned_line=Project::find($project->id)->assigned_line;
        $project["assigned_line_id"]=$assigned_line->name;
        $fraquencyOfActivity=Project::find($project->id)->fraquency;
        $status=Project::find($project->id)->status;
        $coordinador_project=Project::find($project->id)->coordinador_project;
        $coordinador_project=Project::findOrFail($project->id)->coordinador_project;
        $coordinador_vinculacion=Project::findOrFail($project->id)->coordinador_vinculacion;
        $coordinador=Project::findOrFail($project->id)->coordinador_id;
        $rector=Project::findOrFail($project->id)->rector_id;
        $project["fraquency_id"]=$fraquencyOfActivity->name;
        $project["status_id"]=$status->name;
        $project["coordinador_project_id"]=$coordinador_project; 
        $project["coordinador_vinculacion_id"]=$coordinador_vinculacion;
        $project["coordinador_id"]=$coordinador;
        $project["rector_id"]=$rector;
        $project["charitable_institution_id"]=Project::find($project->id)->CharitableInstitution;
        $project["career_id"]=Career::where('careers.id',$project->career_id)
        ->join('catalogues','careers.modality_id','=','catalogues.id')
        ->first(["careers.id","careers.name","catalogues.name as modality"]);
        $project_env[]=$project;
      }
      return $project_env;
    }
    //Coordinadores de otras carreras
    if($request->rol=="codinadoor_de otra cosa"){
      $project_last=Project::where("career_id",1)->get(["id"]);
      for ($i=0; $i < $project_last->count() ; $i++) { 
        $project=Project::find($project_last[$i])->first();
        $assigned_line=Project::find($project->id)->assigned_line;
        $fraquencyOfActivity=Project::find($project->id)->fraquency;
        $status=Project::find($project->id)->status;
        $coordinador_project=Project::find($project->id)->coordinador_project;
        $coordinador_project=Project::findOrFail($project->id)->coordinador_project;
        $coordinador_vinculacion=Project::findOrFail($project->id)->coordinador_vinculacion;
        $coordinador=Project::findOrFail($project->id)->coordinador_id;
        $rector=Project::findOrFail($project->id)->rector_id;
        //sobrescribir en las fk
        $project["assigned_line_id"]=$assigned_line->name;
        $project["fraquency_id"]=$fraquencyOfActivity->name;
        $project["status_id"]=$status->name;
        $project["coordinador_project_id"]=$coordinador_project;
        $project["coordinador_vinculacion_id"]=$coordinador_vinculacion;
        $project["coordinador_id"]=$coordinador;
        $project["rector_id"]=$rector;    
        $project["charitable_institution_id"]=Project::find($project->id)->CharitableInstitution;
        $project["career_id"]=Career::where('careers.id',$project->career_id)
        ->join('catalogues','careers.modality_id','=','catalogues.id')
        ->first(["careers.id","careers.name","catalogues.name as modality"]);
        $project_env[]=$project;
      }
      return $project_env;
    }
 }

 public function create(Request $request){
  
  //CharatableInstitution
   $CharitableInstitution= new CharitableInstitution; 

   $CharitableInstitution->state_id=1;
   $CharitableInstitution->ruc=  $request->ruc;
   $CharitableInstitution->name= $request->name_institution;
   $CharitableInstitution->location_id= $request->location_id;
   $CharitableInstitution->indirect_beneficiaries=$request->indirect_beneficiaries;
   $CharitableInstitution->legal_representative_name=$request->legal_representative_name;
   $CharitableInstitution->legal_representative_lastname=$request->legal_representative_lastname;
   $CharitableInstitution->legal_representative_identification=$request->legal_representative_identification;
   $CharitableInstitution->project_post_charge=$request->project_post_charge;
   $CharitableInstitution->direct_beneficiaries=$request->direct_beneficiaries;
   $CharitableInstitution->save();
   //fk Search
   $fkCharitableInstitution=CharitableInstitution::where('ruc', $request->ruc)->first();
   //project    
   $Project=new Project;
   $Project->charitable_institution_id=$fkCharitableInstitution->id;                 
  // $Project->academi_period_id=$fkacademiPreriod->id;
   $Project->career_id=$request->career_id;
   $Project->assigned_line_id=$request->assigned_line_id;
   $Project->code=$request->code;
   $Project->name=$request->project_name;
   $Project->status_id= $request->status_id;
   $Project->state_id=1;
   $Project->field=$request->field;
   $Project->aim=$request->aim;
   $Project->fraquency_id=$request->fraquency_id;
   $Project->cycle=$request->cycle;
   $Project->location_id=$request->location_project; //localitation'
   $Project->lead_time=$request->lead_time;
   $Project->delivery_date=$request->delivery_date;// tiempo
   $Project->start_date=$request->start_date;// tiempo
   $Project->end_date=$request->end_date;//tienmpo
   $Project->description=$request->description;
   $Project->coordinator_name=$request->coordinator_name;
   $Project->coordinator_lastname=$request->coordinator_lastname;
   $Project->coordinator_postition=$request->coordinator_postition;
   $Project->coordinator_funtion=$request->coordinator_funtion;
   $Project->introduction=$request->introduction;
   $Project->situational_analysis=$request->situational_analysis;
   $Project->foundamentation=$request->foundamentation;
   $Project->rector_id=$request->rector_id;
   $Project->coordinador_id=$request->coordinador_id;
   $Project->coordinador_vinculacion_id=$request->coordinador_vinculacion_id;
   $Project->coordinador_project_id=$request->coordinador_project_id;
   $Project->justification=$request->justification;
   $Project->bibliografia=$request->bibliografia;
   $Project->save();
  
   //fk Project searh
   $fkProject=Project::where('code',$request->code)->first("id");
   //SpecificAim
   
   for($con=0;$con<count($request->type_id_specific);$con++){
    $fkaims=$request->parent_code_id[$con] <> null ? SpecificAim::where('description',$request->parent_code_id[$con])->first("id") : (object) array("id"=>null);
    $this->aimsCreate(
      $fkProject->id,
      $request->type_id_specific[$con],
      $request->description_aims[$con],
      $request->indicator[$con],
      $request->verifications[$con],
      $fkaims->id
    );  
   }
  //ProjectActivities
    for($con=0;$con<count($request->type_id_activities);$con++){
    $this->projectActivitiesCreate($fkProject->id,$request->type_id_activities[$con],$request->detail_activities[$con]);
   } 
  //img 
  /*$filePath = $request->logo->storeAs('charitable_institution',  $fkCharitableInstitution->name. '.png', 'public');
  $images= new Image;
  $images->code=$fkCharitableInstitution->ruc;
  $images->name=$fkCharitableInstitution->name;
  $images->description='Este es para el uso de los pdf de vinculacion';
  $images->uri=$filePath;
  $images->type=Image::AVATAR_TYPE;
  $images->state_id=1;
  $images->save(); */


   return true; 
  }


  public function aimsCreate($id_project,$type_id,$description,$indicator,array $verifications,$parent_code_id){
    $SpecificAim = new SpecificAim;
    $SpecificAim->state_id=1;
    $SpecificAim->project_id=$id_project;
    $SpecificAim->indicator=$indicator;
    $SpecificAim->verifications=$verifications;
    $SpecificAim->description=$description;
    $SpecificAim->type_id=$type_id;
    $SpecificAim->parent_code_id=$parent_code_id;
    $SpecificAim->save();
  }
  public function projectActivitiesCreate($id_project,$type_id,$detail){
    $ProjectActivities= new ProjectActivities;
    $ProjectActivities->state_id=1;
    $ProjectActivities->project_id=$id_project;
    $ProjectActivities->type_id=$type_id;
    $ProjectActivities->$detail;
    $ProjectActivities->save();
  }

  public function studentParticipantCreate($id_project,$id_student,$funtionStudent){
    $Student= new StudentParticipant;
    $Student->state_id=1;
    $Student->student_id=$id_student;
    $Student->project_id=$id_project;
    $Student->funtion_id=$funtionStudent;
    $Student->save();
  }
  public function teacherParticipantCreate($id_project,$teacher_id,$workHours,$funtionTeacher){
    $Teacher=new TeacherParticipant;
    $Teacher->state_id=1;
    $Teacher->teacher_id=$id_project;
    $Teacher->project_id=$teacher_id;
    $Teacher->workHours=$workHours;
    $Teacher->funtion_id=$funtionTeacher;
    $Teacher->save();
  }

  public function destroy($id){
    if(!!ProjectActivities::where('project_id',$id)->get()){
      DB::connection('pgsql-community')->table('project_activities')->where('project_id', $id)->delete();
    } 
    if(!!StudentParticipant::where('project_id',$id)->get()){ 
      DB::connection('pgsql-community')->table('student_participants')->where('project_id', $id)->delete();
    }  
    if(!!TeacherParticipant::where('project_id',$id)->get()){
      DB::connection('pgsql-community')->table('teacher_participants')->where('project_id', $id)->delete();
    }
    if(!!SpecificAim::where('project_id',$id)->get()){
      DB::connection('pgsql-community')->table('specific_aims')->where('project_id', $id)->delete();
    }
    /* if(!!Observation::where('project_id',$id)->get()){ 
      DB::connection('pgsql-community')->table('observations')->where('project_id', $id)->delete();
    } */
    if(!!Project::find($id)->get()){
      DB::connection('pgsql-community')->table('projects')->where('id', $id)->delete();
    }else{
      return "No existe el proyecto";
    }
      return "proyecto eliminado";
  }
  public function edit($id){
    
    $project=Project::where("id",$id)->first();
    $assigned_line=Project::find($id)->assigned_line;
    $fraquencyOfActivity=Project::find($id)->fraquency;
    $status=Project::find($id)->status;
    $coordinador_project=Project::findOrFail($id)->coordinador_project;
    $coordinador_vinculacion=Project::findOrFail($id)->coordinador_vinculacion;
    $coordinador=Project::findOrFail($id)->coordinador_id;
    $rector=Project::findOrFail($id)->rector_id;
   //sustitucion de datos Carrera modelo fk belongto Catalogue
    $project["career_id"]=Career::where('careers.id',$project->career_id)
    ->join('catalogues','careers.modality_id','=','catalogues.id')
    ->first(["careers.id","careers.name","catalogues.name as modality"]);
    $project["assigned_line_id"]=$assigned_line->name;
    $project["fraquency_id"]=$fraquencyOfActivity->name;
    $project["status_id"]=$status->name;
    $project["coordinador_project_id"]=$coordinador_project;
    $project["coordinador_vinculacion_id"]=$coordinador_vinculacion;
    $project["coordinador_id"]=$coordinador;
    $project["rector_id"]=$rector;
    $project["charitable_institution_id"]=Project::find($id)->CharitableInstitution; //CharitableInstitution::where("id",$project->charitable_institution_id)->first();
   //nuevos datos de otras tablas 
   //array de carga 
    $projectActivities_env=array();
    $studentParticipant_env=array();
    $teacherParticipant_env=array();
    $specificAim_env=array();
    //recorridos y cargas de los ARRAYS 
    $studentParticipantv=StudentParticipant::where("project_id",$id)->get(["id"]);
    for ($i=0; $i < $studentParticipantv->count(); $i++) { 
      $studentParticipant=StudentParticipant::find($studentParticipantv[$i])->first();
      $studentParticipant["student_id"]=StudentParticipant::find($studentParticipant->id)->student;
      $studentParticipant["funtion_id"]=StudentParticipant::find($studentParticipant->id)->funtion;
      $studentParticipant_env[]=$studentParticipant;
    }
    $teacherParticipantv=TeacherParticipant::where("project_id",$id)->get(['id']);
    for ($i=0; $i < $teacherParticipantv->count(); $i++) { 
      $teacherParticipant=TeacherParticipant::find($teacherParticipantv[$i])->first();
      $teacherParticipant["teacher_id"]=TeacherParticipant::find($teacherParticipant->id)->teacher;
      $teacherParticipant["funtion_id"]=TeacherParticipant::find($teacherParticipant->id)->funtion;
      $teacherParticipant_env[]=$teacherParticipant;
    }
    $specificAimv=SpecificAim::where("project_id",$id)->get(['id']);
    for ($i=0; $i < $specificAimv->count(); $i++) { 
      $specificAim=SpecificAim::find($specificAimv[$i])->first();
      $specificAim["type_id"]=SpecificAim::find($specificAim->id)->type;
      $specificAim_env[]=$specificAim;
    }
    $projectActivity=ProjectActivities::where("project_id",$id)->get(['id']); 
    for ($i=0; $i < $projectActivity->count(); $i++) { 
      $projectActivities=ProjectActivities::find($projectActivity[$i])->first();
      $projectActivities["type_id"]=ProjectActivities::find($projectActivities->id)->type;
      $projectActivities_env[]=$projectActivities;
    }
    $observation=!!Observation::where('project_id',$id)->get() ? Observation::where('project_id',$id)->get():[];
    $pdf= array(
      'project'=>$project,
      'studentParticipant'=>$studentParticipant_env,
      'teacherParticipant'=>$teacherParticipant_env,
      'specificAim'=>$specificAim_env,
      'projectActivities'=>$projectActivities_env,
      'observation'=>$observation,

    );
    
    
    return $pdf;
    
   }

  public function creador(Request $request){
    $vista=Project::select('status_id')->get();
    return $vista;
  }

}