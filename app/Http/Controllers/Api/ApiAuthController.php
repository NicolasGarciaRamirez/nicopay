<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
	public function login(Request $request)
	{
		$user = User::whereEmail($request->email)->first();
		$credentials = $request->only('email', 'password');
		if(!$user){
			return response()->json([
				'errors' => ['Este usuario no esta registrado en el sistema, comunicate con el administrador del sistema']
			], 500);
		}

		if(Auth::attempt($credentials, true)){
			return response()->json([
				'user' => $user,
				'token' => $user->createToken('sdkAccess')->plainTextToken,
				'auth' => true,
				'errors' => null
			], Response::HTTP_OK);
		}else{
			return response()->json([
				'user' => $user,
				'auth' => false,
				'errors' => ['Email Or Password Incorrect']
			], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
}