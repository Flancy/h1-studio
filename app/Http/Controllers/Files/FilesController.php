<?php

namespace App\Http\Controllers\Files;

use App\Files;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $files = DB::table('files')->orderBy('created_at', 'desc')->paginate(9);

        if($request->ajax()){
            return Response::json($files);
        }
        
        return view('files.index', ['files' => $files]);
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
        $files = new Files();

        if($request->hasFile('file')){
            $filename = md5(microtime()).$request->file->getClientOriginalName();
            $request->file('file')->storeAs(
                '/public/file', $filename
            );
            $path = '/public/storage/file/'.$filename;
        } else {
            return Response::json(false);
        }

        return $files::create([
            'projects_id' => $request['projects_id'],
            'name' => $request['name'],
            'type' => $request->file->getClientOriginalExtension(),
            'src' => $path
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, Files $files)
    {
        
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
    public function destroy($id, Files $files)
    {
        $files = $files->find($id)->delete(); 

        if($files) {
            return Response::json(true);
        }

        return Response::json(false);
    }
}
