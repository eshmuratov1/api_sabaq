<?php

namespace App\Http\Controllers;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
        ]);
    }


    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user or !Hash::check($request->password, $user->password)){
            return "user not found or password incorrect";
        }

        $token = $user->createToken('todoapp') ;
        return response([
            'id' => $user->id,
            'name' => $user->name,
            'token' => $token->plainTextToken
        ]);
    }


    public function getme(Request $request)
    {
        return $request->user();
    }
}
