<?php

namespace App\Http\Controllers\Articles;

use App\Articles;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = DB::table('articles')->orderBy('created_at', 'desc')->paginate(9);
        if($request->ajax()){
            return Response::json($articles);
        }
        
        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->isAdmin()) {
            return redirect('home');
        }

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!Auth::user()->isAdmin()) {
            return redirect('home');
        }

        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'url' => 'unique:articles',
            ]);

            if ($validator->fails()) {    
                return response()->json($validator->errors(), 400);
            }

            $articles = new Articles();

            if($request->hasFile('photo')){
                $filename = md5(microtime()).$request->photo->getClientOriginalName();
                $request->file('photo')->storeAs(
                    '/public/articles', $filename
                );
                $path = '/public/storage/articles/'.$filename;
            } else {
                $path = '/public/storage/articles/article-default.jpg';
            }

            return $articles::create([
                'title' => $request['title'],
                'short_description' => $request['short_description'],
                'description' => $request['description'],
                'url' => $request['url'],
                'photo' => $path,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, Articles $articles)
    {
        $articles = $articles->find($id);

        if($request->ajax()){
            return Response::json($articles);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function edit(Articles $articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articles $articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Articles $articles)
    {
        if(!Auth::user()->isAdmin()) {
            return redirect('home');
        }

        $articles = $articles->find($id)->delete(); 

        if($articles) {
            return Response::json(true);
        }

        return Response::json(false);
    }
}
