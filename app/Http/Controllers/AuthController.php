<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules=[
            'email' => 'required',
            'name' => 'required',
            'password' => 'required',

        ];
        $this->validate($request,$rules);
        $user=User::create(['name'=>$request->name,'email'=>$request->email,'password'=>Hash::make($request->password)]);
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json([
                'message'=>'Invalid login details'
            ]);
        }
        $user=User::where('email',$request['email'])->firstOrFail();
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ]);
    }
    public function infouser(Request $request){
        return $request->user();
    }
}
