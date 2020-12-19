<?php

namespace App\Http\Controllers\Community;

use App\Models\Cecy\Modelo1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Community\Objetive;

class objetiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cecy\Modelo1  $modelo1
     * @return \Illuminate\Http\Response
     */
    public function show(Modelo1 $modelo1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cecy\Modelo1  $modelo1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelo1 $modelo1)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cecy\Modelo1  $modelo1
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelo1 $modelo1)
    {
        //
    }

    public function aimsCreate($id_project,array $objective){
        $condicion=[
            ["project_id",$id_project],
            ["description",$objective["children"]["description"]],
            
          ]; 
          $fkaims=$objective["children"]["description"] <> null ?
            Objetive::where($condicion)->first()->id: 
            null;
        $SpecificAim = new Objetive;
        $SpecificAim->state_id=1;
        $SpecificAim->project_id=$id_project;
        $SpecificAim->indicator= $objective["indicator"];
        $SpecificAim->means_verification=$objective["means_verification"];
        $SpecificAim->description=$objective["description"];
        $SpecificAim->type=$objective["type"]["id"];
        $SpecificAim->children=$fkaims;
        $SpecificAim->save();
    }
    public function aimsUpdate($id_project,array $objective,$parent_code_id){
        $SpecificAim = Objetive::find($objective["id"]);
        $SpecificAim->state_id=1;
        $SpecificAim->project_id=$id_project;
        $SpecificAim->indicator= $objective["indicator"];
        $SpecificAim->means_verification=$objective["means_verification"];
        $SpecificAim->description=$objective["description"];
        $SpecificAim->type=$objective["type"]["id"];
        $SpecificAim->children=$parent_code_id->id;
        $SpecificAim->save();
      }
}

/*  
    obejetive:[
        mv:asda 
        i:documento   
        d:desraoollar un sistemas erb quw de todo
        t:2 //cata logo objE resultado obg actividad 
        obj<-obs<-actividad o 
        children: desraoollar un sistemas erb quw de todo
        ]
    ]
*/
