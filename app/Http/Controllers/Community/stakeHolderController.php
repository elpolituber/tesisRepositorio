<?php

namespace App\Http\Controllers\Community;

use App\Models\Cecy\Modelo1;
use App\Http\Controllers\Controller;
use App\models\Community\StakeHolder;
use Illuminate\Http\Request;

class stakeHolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($stakeHolder)
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cecy\Modelo1  $modelo1
     * @return \Illuminate\Http\Response
     */
    public function show(Modelo1 $modelo1)
    {
        
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
     * 
     */
    public function destroy(Modelo1 $modelo1)
    {
        //
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
        $stakeHolder->save();
    }
    public function stakeHolderUpdate($id_project,array $stakeHolders){
        $stakeHolder=StakeHolder::find($stakeHolders["id"]);
        $stakeHolder->state_id=1;
        $stakeHolder->project_id=$id_project;
        $stakeHolder->name=$stakeHolders["name"];
        $stakeHolder->lastname=$stakeHolders["lastname"];
        $stakeHolder->identification=$stakeHolders["identification"];
        $stakeHolder->position=$stakeHolders["position"];
        $stakeHolder->type=$stakeHolders["type"]["id"];
     //   $stakeHolder->function=$stakeHolders["function"]["id"];
        $stakeHolder->save();
    }

}
