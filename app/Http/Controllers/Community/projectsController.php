<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Community\Project;
use App\Models\Community\BeneficiaryInstitution;
use App\Models\Community\Objetive;
use App\Models\Community\Activities;
use App\Models\Community\Participant;
use App\Models\Ignug\Image;
use App\Models\Community\StakeHolder;
use Illuminate\Support\Facades\Storage;
use App\Models\Authentication\Role;


class projectsController extends Controller
{

  public function show(Request $request){
    $project_env=array();
    //coodinador de vinculacion
    $projects=Project::with(['frequency_activities'=>function($frequency_activity){$frequency_activity;}])
      ->with(['school_period'=>function($school){$school;}])
      ->with(['BeneficiaryInstitution'=>function($BeneficiaryInstitution){
        $BeneficiaryInstitution->with('state')
        ->with(['address'=>function($address){
          $address;}]);
      }])
      ->with(['status'=>function($status){
       // $status->with('state');
      }])
      ->with(['career'=>function($career){
        $career->with('state')
          ->with(['modality'=>function($modality){$modality->with('state');}]);
      }])
      //->with('state')
      ->with(['location'=>function($location){
    //    $location->with('state');
      }])
      ->with(['participant'=>function($participants){
         $participants//->with('state')
         ->with(['user'=>function($user){$user->with('state');}])
         ->with(['type'=>function($type){$type->with('state');}])
         ->with(['function'=>function($function){$function->with('state');}]);
      }])
      ->with(['activities'=>function($activity){
        $activity->with('state')
        ->with(['type'=>function($type){$type->with('state');}]);
      }])
      ->with(['stake_holder'=>function($function){
        $function->with('state')
        ->with('type');
      }])
      ->with(['objetive'=>function($objetive){
        $objetive->with('children')
          ->with('type');
      }])->where($this->rol($request->role_id ,$request->career_id, $request->user_id))
      
       ->get();
    
    return $projects;
    
 }

 public function create(Request $request){
  //img 
  $filePath = !!$request->beneficiary_institution["logo"] <> null?
  $request->beneficiary_institution["logo"]->storeAs('charitable_institution',  $request->beneficiary_institution["name"]. '.png', 'public')
  :null;  
  //CharatableInstitution
   $CharitableInstitution= new BeneficiaryInstitution; 
   $CharitableInstitution->state_id=1;
   $CharitableInstitution->logo=$filePath;
   $CharitableInstitution->ruc=$request["beneficiary_institution"]["ruc"];
   $CharitableInstitution->name=$request->beneficiary_institution["name"];
   $CharitableInstitution->address= $request->beneficiary_institution["address"];
   $CharitableInstitution->legal_representative_name=$request->beneficiary_institution["legal_representative_name"];
   $CharitableInstitution->legal_representative_lastname=$request->beneficiary_institution["legal_representative_lastname"];
   $CharitableInstitution->legal_representative_identification=$request->beneficiary_institution["legal_representative_identification"];
   $CharitableInstitution->function=$request->beneficiary_institution["function"];
   $CharitableInstitution->save();
   //fk Search
     $fkCharitableInstitution=BeneficiaryInstitution::where('ruc', $request->beneficiary_institution["ruc"])->first();
   //project    
    $Project=new Project;
    $Project->beneficiary_institution=$fkCharitableInstitution->id;                 
  //  $Project->school_period=$request->school_period;
    $Project->career_id=$request->career["id"];
  //  //$Project->assigned_line_id=$request->assigned_line_id;
    $Project->code=$request->code;
    $Project->title=$request->title;
    $Project->status_id= $request->status["id"];
    $Project->state_id=1;
    $Project->field=$request->field;//campo nulleable
  // //  $Project->aim=$request->aim;//ojo no exixste pero proximo cambio
    $Project->frequency_activities=$request->frequency_activities["id"];
    $Project->cycle=$request->cycle;
    $Project->location_id=$request->location["id"]; //localitation'
    $Project->lead_time=$request->lead_time;
    $Project->delivery_date=$request->delivery_date;// tiempo
    $Project->start_date=$request->start_date;// tiempo
    $Project->end_date=$request->end_date;//tienmpo
    $Project->description=$request->description;
   $Project->indirect_beneficiaries=$request->indirect_beneficiaries;
   $Project->direct_beneficiaries=$request->direct_beneficiaries;
   $Project->introduction=$request->introduction;
   $Project->situational_analysis=$request->situational_analysis;
   $Project->foundamentation=$request->foundamentation;
   $Project->justification=$request->justification;
   $Project->create_by=$request->create_by;
   $Project->bibliografia=$request->bibliografia;
   $Project->observations=$request->observations;
   $Project->save();
   //fk Project searh
   $fkProject=Project::where('code',$request->code)->first("id");
   //Objective
   for($con=0;$con<count($request->objetive);$con++){
    $objective=$request->objetive[$con];
    $fkaims=$objective["children"] <> null ?
    Objetive::where('description',$objective["description"])->first("id")->id : 
    (object) array("id"=>null);
    $this->aimsCreate(
      $fkProject->id,
      $objective,
      $fkaims
    );  
   }
  //ProjectActivities
    for($con=0;$con<count($request->activities);$con++){
    $activity=$request->activities[$con];
    $this->projectActivitiesCreate(
      $fkProject->id,
      $activity
    );
   }
   //Participant
   for($con=0;$con<count($request->participant);$con++){
      $participant=$request->participant[$con];
      $this->participantCreate(
        $fkProject->id,
        $participant
      );
    } 
    //stakeHolderCreate
    for($con=0;$con<count($request->stake_holder);$con++){
        $stakeHolder=$request->stake_holder[$con];
        $this->stakeHolderCreate(
          $fkProject->id,
          $stakeHolder
        );
    }
   return true; 
  }


  public function aimsCreate($id_project,array $objective,$parent_code_id){
    $SpecificAim = new Objetive;
    $SpecificAim->state_id=1;
    $SpecificAim->project_id=$id_project;
    $SpecificAim->indicator= $objective["indicator"];
    $SpecificAim->means_verification=$objective["means_verification"];
    $SpecificAim->description=$objective["description"];
    $SpecificAim->type=$objective["type"]["id"];
    $SpecificAim->children=$parent_code_id;
    $SpecificAim->save();
  }
  public function projectActivitiesCreate($id_project,array $activities){
    $ProjectActivities= new Activities;
    $ProjectActivities->state_id=1;
    $ProjectActivities->project_id=$id_project;
    $ProjectActivities->type_id=$activities["type"]["id"];
    $ProjectActivities->description=$activities["description"];
    $ProjectActivities->save();
  }

  public function participantCreate($id_project,array $participants){
    $participant= new Participant;
    $participant->state_id=1;
    $participant->user_id=$participants["user"]["id"];
    $participant->project_id=$id_project;
    $participant->type=$participants["type"]["id"];
    $participant->position=$participants["position"];
    $participant->working_hours=$participants["working_hours"];
    $participant->function=$participants["function"]["id"];
    $participant->save();
  }
  public function stakeHolderCreate($id_project,array $stakeHolders){
    $stakeHolder=new StakeHolder;
    $stakeHolder->state_id=1;
    $stakeHolder->project_id=$id_project;
    $stakeHolder->name=$stakeHolders["name"];
    $stakeHolder->lastname=$stakeHolders["lastname"];
    $stakeHolder->identification=$stakeHolders["identification"];
    $stakeHolder->position=$stakeHolders["position"];
    $stakeHolder->type=$stakeHolders["type"]["id"];
    $stakeHolder->function=$stakeHolders["function"]["id"];
    $stakeHolder->save();
  }

  public function destroy($id){
    // cambiar de estado de 1 a 2
    $Project=Project::find($id);
    $Project->state_id=2;
      return "proyecto eliminado";
  }
  public function edit($id){
    $projects=Project::with(['frequency_activities'=>function($frequency_activity){$frequency_activity;}])
      ->with(['school_period'=>function($school){$school;}])
      ->with(['BeneficiaryInstitution'=>function($BeneficiaryInstitution){
        $BeneficiaryInstitution->with('state')
        ->with(['address'=>function($address){$address;}]);
      }])
      ->with(['status'=>function($status){
       // $status->with('state');
      }])
      ->with(['career'=>function($career){
        $career->with('state')
          ->with(['modality'=>function($modality){$modality->with('state');}]);
      }])
      //->with('state')
      ->with(['location'=>function($location){
    //    $location->with('state');
      }])
      ->with(['participant'=>function($participants){
         $participants//->with('state')
         ->with(['user'=>function($user){$user->with('state');}])
         ->with(['type'=>function($type){$type->with('state');}])
         ->with(['function'=>function($function){$function->with('state');}]);
      }])
      ->with(['activities'=>function($activity){
        $activity->with('state')
        ->with(['type'=>function($type){$type->with('state');}]);
      }])
      ->with(['stake_holder'=>function($function){
        $function->with('state')
        ->with('type');
      }])
      ->with(['objetive'=>function($objetive){
        $objetive->with('children')
          ->with('type');
      }])
      ->where('id',$id)
      ->get();
    
    return $projects;
    
   }
   public function update(Request $request, $id){
     
   }
  public function rol($rol=2, $career=1,$user=1){
    $i=1;
    $Rol=[
      [],
      ['code','CAREER_COORDINATOR'],
      ['code','COMMUNITY_COORDINATOR'],
      ['code','teacher'],
    ];
    $Condicion=[
      [],
      [//CAREER_COORDINATOR coodinador de carrera 0
        ['career_id', $career],
        ['projects.state_id',1]
      ],
      [//COMMUNITY_COORDINATOR coodrinador de vincyulacion 1
        ['projects.state_id',1],
        ['projects.state_id',1]
      ],
      [//TEACHER   
        ['projects.state_id',1],
        ['create_by',$user],
      ]
    ];
    do{
   $valor=!!Role::where($Rol[$i][0],$Rol[$i][1])->first('id') ?
    Role::where($Rol[$i][0],$Rol[$i][1])->first('id'):
    (object) array("id"=>0);
      if($rol==$valor->id){
        return $Condicion[2];
      }
      $i++;
    }while($rol== $valor->id ||  $i<count($Rol));  
    
    
  }
  public function creador(Request $request){
    $vista=count($request->objetive);//Role::all();   
    return $vista;
  }

}

    /**
     * $request->role_id 
     * $request->user_id 
     * $request->institution_id se necesita
     * $request->career_id ADMINISTRADOR
      *ESTUDIANTE
      *PROFESOR
      *RECTOR
      *VICERRECTOR
      *CONSERJE
      *COORD. CARRERA
      *COORD. ACADEMICO
      *COORD. VINCULACION
      *COORD. INVESTIGACION
      *COORD. ADMINISTRATIVO
      *ADMIN
      *STUDENT
      *TEACHER
      *CHANCELLOR
      *VICE_CHANCELLOR
      *CONCIERGE
      *CAREER_COORDINATOR
      *ACADEMIC_COORDINATOR
      *COMMUNITY_COORDINATOR
      *INVESTIGATION_COORDINATOR
      *ADMINISTRATIVE_COORDINATOR
     */