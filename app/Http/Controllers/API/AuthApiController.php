<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\LoginService;
use Hash;
use Illuminate\Http\Request;

class AuthApiController extends Controller
{
    public function __construct(private  LoginService  $loginService)
    {

    }

   public function login (LoginRequest $request)
   {
         $data=$request->afterValidation();
         $user = User::where('email', $data['email'])->first();
         if (!Hash::check($data['password'], $user->password)) {
             return $this->response(message: 'The provided credentials are incorrect.', code: 401);
         }
         $user->token = $user->createToken('auth_token')->plainTextToken;
         return $this->response(UserResource::make($user));
   }
}
