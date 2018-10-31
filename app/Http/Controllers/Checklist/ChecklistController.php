<?php

namespace App\Http\Controllers\Checklist;

use App\ChecklistsUser;
use App\Projects;
use Response;
use Illuminate\Support\Facades\Auth;;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChecklistController extends Controller
{
    public function getAllChecklist($id, Request $request)
    {
        $checklist = ChecklistsUser::where('projects_id', $id)
           ->orderBy('id', 'desc')
           ->get();

        if($request->ajax()){
            return Response::json($checklist);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
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
        if($request->ajax()){
            $checklist = ChecklistsUser::create([
                'projects_id' => $request['todo']['projects_id'],
                'user_id' => Auth::id(),
                'status' => $request['todo']['status'],
                'description' => $request['todo']['description'],
                'type' => $request['todo']['type'],
            ]);

            return Response::json($checklist);
        }

        return Response::json(false);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
