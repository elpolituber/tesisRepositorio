<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use App\Models\Community\Project;
use Illuminate\Http\Request;
use App\Models\Ignug\Career;
use App\Models\Ignug\Catalogue;



class combosController extends Controller
{//objeto se fue
  public function show(){
    $fraquencyOfActivity=Catalogue::where('type','fraquency_activity_vinculacion')->get(["name","id","type"]);
    $assignedLine=Catalogue::where('type','assigned_line_vinculacion')->get(["name","id","type"]);
    $linkageAxes=Catalogue::where('type','linkage_axes_vinculacion')->get(["name",'id',"type"]);//ejes de vinculacion
    $bondingActivities=Catalogue::where('type','bonding_activities_vinculacion')->get(["name","id","type"]);//Actividad de vinculación
    $researchAreas=Catalogue::where('type','research_areas_vinculacion')->get(["name","id","type"]);//rea de investigacion
    $aims=Catalogue::where('type','aims_types_vinculacion')->get(["name","id","type"]);
    $funtionTeacher=Catalogue::where('type','funtion_vinculacion')->get(["name","id","type"]);
    $status=Catalogue::where('type','status_vinculacion')->get(["name","id","type"]);
    $cargo=Catalogue::where('type','cargo_vincualcion')->get(["name","id","type"]);
    $combos=array(
        "assignedLine"=>$assignedLine,
        "linkageAxes"=>$linkageAxes,
        "bondingActivities"=>$bondingActivities,
        "fraquencyOfActivity"=>$fraquencyOfActivity,
        "research_areas"=>$researchAreas,
        "objective"=>$aims,
        "teacher_funtion"=>$funtionTeacher,
        "status"=>$status,
        "cargo"=>$cargo,
      );
    return $combos;
 }
 public function create(Request $request){
    $value=$this->indice($request->type);
    $catalogue= new Catalogue;
    $catalogue->code =$value;
    $catalogue->name = $request->name;
    $catalogue->type = $request->type;//revisar
    $catalogue->state_id=1 ;
    $catalogue->save();
    return "se han completado su peticion";
 }
 
public function indice($type){
  $value=Catalogue::where('type',$type)->count();
  if($type == 'status_vinculacion'){
    return 'status_'.$value+1;
  }
  if($type =='fraquency_activity_vinculacion'){
    return 'fraquency_activity_'.$value+1;
  }
  if($type =='assigned_line_vinculacion'){
    return 'assigned_line_'.$value+1;
  }
  if($type =='linkage_axes_vinculacion'){
    return 'linkage_axes_'.$value+1;
  }
  if($type =='aims_types_vinculacion'){
    return 'aims_types_'.$value+1;
  }
  if($type =='bonding_activities_vinculacion'){
    return 'bonding_activities_'.$value+1;
  }
  if($type =='research_areas_vinculacion'){
    return 'research_areas_'.$value+1;
  }
  if($type =='cargo_vincualcion'){
    return 'research_areas_'.$value+1;
  }
  if($type =='funtion_vinculacion'){
    return 'funtion_'.$value+1;
  }
}
 
}