<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Hash;
use Auth;

class PassportController extends Controller
{
	public function login(Request $request) 
    {
    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password
    	];

    	if(auth()->attempt($credentials)) {
    		$user = Auth::user();
			$token = $user->createToken('Laravel')->accessToken;
			return response()->json(['token' => $token,"user"=>$user->name], 200);
    	} else {
			return response()->json([
				"token" => "UnAuthorised"], 201);
    	}

    }

    public function register(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'name' => 'required|min:3',
    		'email' => 'required|email|unique:users',
    		'username' =>'required|min:3',
    		'password' => 'required|min:6'
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['error' => $validator->errors()]);
    	}

    	$user = new User;
    	$user->name = $request->name;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);

    	$user->save();

		$token = $user->createToken('Laravel')->accessToken;
    	return response()->json(["token"=> $token, "user"=>$user->name], 200);
    }

    public function details() 
    {
    	$user = Auth::user();
    	return response()->json(['token' => $user], 200);
    }
	public function logout()
    { 
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
        }
    }
}
