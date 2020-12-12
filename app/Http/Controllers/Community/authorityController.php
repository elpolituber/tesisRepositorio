<?php

namespace App\Http\Controllers\Community;

use App\Models\Cecy\Modelo1;
use App\Http\Controllers\Controller;
use App\Models\Community\Authorities;
use Illuminate\Http\Request;

class authorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $authority = new Authorities;
        $authority->user_id=$request->user_id;
        $authority->type_id=$request->type_id;
        $authority->status_id=$request->status_id;
        $authority->career_id=$request->career_id;
        $authority->code=$request->code;
        $authority->name=$request->name;
        $authority->start_date=$request->start_date;
        $authority->end_date=$request->end_date;
        $authority->state_id=1;
        $authority->save();
        return Authorities::where("status_id","En funcion")->get();
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
}
