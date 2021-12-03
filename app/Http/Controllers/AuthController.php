<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

$data = $request->validate([

    'name' => 'required|string|max:191',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|string'
]);


$user = User::create([

    'name' => $data['name'],
    'email' => $data['name'],
    'password' => Hash::make($data['password'])
]);


$token = $user->createToken('ApiToken')->plainTextToken;

$response = [
    'user' => $user,
    'token' => $token
];

header('Content-type: application/json');
return response($response,201);



    }
}
