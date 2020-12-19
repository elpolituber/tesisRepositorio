<?php

namespace App\Http\Controllers\Community;

use App\Models\Cecy\Modelo1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Community\Activities;

class activityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
    public function projectActivitiesCreate($id_project,array $activities){
        $ProjectActivities= new Activities;
        $ProjectActivities->state_id=1;
        $ProjectActivities->project_id=$id_project;
        $ProjectActivities->type_id=$activities["type"]["id"];
        $ProjectActivities->description=$activities["description"];
        $ProjectActivities->save();
    }
    public function projectActivitiesUpdate($id_project,array $activities){
        $ProjectActivities=Activities::find( $activities["id"]);
        $ProjectActivities->state_id=1;
        $ProjectActivities->project_id=$id_project;
        $ProjectActivities->type_id=$activities["type"]["id"];
        $ProjectActivities->description=$activities["description"];
        $ProjectActivities->save();
        }
}
