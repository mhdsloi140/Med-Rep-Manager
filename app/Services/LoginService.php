<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Models\Admin;
use App\Models\User;
use Arr;
use Hash;




class LoginService
{

    public function all($data )
   {
        $user=User::where("email", $data["email"])->first();
        if (!Hash::check($data['password'], $user->password)) {
            return $this->response(message: 'The provided credentials are incorrect.', code: 401);
        }
        $user->token = $user->createToken('auth_token')->plainTextToken;
        return $user;


    }

   public function store($data)
   {
        $admin = Admin::create(Arr::except($data, ['email']));
        $data['userable_type']=UserableEnum::Admin->value;
        $data['userable_id']=$admin->id;
        $password=rand();
        $data['password'] = bcrypt($data['password']);
        $user=User::create(Arr::only($data,['email','name','password','userable_type','userable_id']));
        // $user=User::create($data(Arr::only()));
        return $admin;
   }


}

