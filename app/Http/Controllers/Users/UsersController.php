<?php

namespace App\Http\Controllers\Users;


use App\User;
use App\Role;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = DB::table('users')->orderBy('created_at', 'desc')->paginate(9);
        if($request->ajax()){
            return Response::json($users);
        }
        
        return view('users.index', ['users' => $users]);
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
    public function store(Request $request, User $user)
    {
        if($request->ajax()){
            if($this->validator($request->all())) {
                $user = User::create([
                    'name' => $request['name'],
                    'full_name' => $request['full_name'],
                    'phone' => $request['phone'],
                    'company' => $request['company'],
                    'description' => $request['description'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);

                $role = Role::find(2);
                $role->users()->save($user);

                return Response::json($user);
            }

            return Response::json(false);
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
        $user = User::findOrFail($id)->delete(); 

        if($user) {
            return Response::json(true);
        }

        return Response::json(false);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'full_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'description' => 'required|string|max:1024',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}
