<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAll()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function show(int $id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
    public function store(Request $request)
    {
        $user = User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'age'=>$request['age']
        ]);
        return response()->json($user);
    }
    public function update(Request $request,int $id)
    {
        $user = User::find($id);
        isset($request['name'])?$name = $request['name']: $name = $user['name'];
        isset($request['email'])?$email = $request['email']: $email = $user['email'];
        isset($request['age'])?$age = $request['age']: $age = $user['age'];
        $user->fill([
            'name'=>$name,
            'email'=>$email,
            'age'=>$age
        ]);
        return response()->json($user);
    }
    public function delete(int $id)
    {
        User::find($id)->delete();
        return response()->json();
    }
}
