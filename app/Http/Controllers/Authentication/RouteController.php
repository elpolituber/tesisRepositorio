<?php

namespace App\Http\Controllers\Authentication;

use App\Models\Authentication\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Route::orderBy('module_id')->get()], 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Route $route)
    {
        //
    }

    public function update(Request $request, Route $route)
    {
        //
    }

    public function destroy(Route $route)
    {
        //
    }
}
