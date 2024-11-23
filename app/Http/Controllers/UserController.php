<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private const USER_VALIDATOR = [
        'email'=>'required|',
        'price'=>'required|numeric',
    ];
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
        $validated = $request->validate(self::USER_VALIDATOR);
        User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'age'=>$validated['age']
        ]);
        return response()->json($validated);
    }
    public function update(Request $request,int $id)
    {
        $validated = $request->validate(self::USER_VALIDATOR);
        $user = User::find($id);
        return response()->json();
    }
    public function delete(int $id)
    {
        User::find($id)->delete();
        return response()->json();
    }
}
