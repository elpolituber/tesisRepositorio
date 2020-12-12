<?php

namespace App\Http\Controllers\Community;

use App\Models\Cecy\Modelo1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Community\Participant;
class participantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function update(Request $request,$id)
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
    public function participantUpdate($id_project,array $participants){
        $participant= $participants["id"];
        $participant->state_id=1;
        $participant->user_id=$participants["user"]["id"];
        $participant->project_id=$id_project;
        $participant->type=$participants["type"]["id"];
        $participant->position=$participants["position"];
        $participant->working_hours=$participants["working_hours"];
        $participant->function=$participants["function"]["id"];
        $participant->save();
    }
}
