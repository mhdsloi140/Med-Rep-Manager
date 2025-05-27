<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Models\Admin;
use App\Models\User;
use Arr;




class AdminService
{

    public function all($data = [], $paginated = true, $withes = [])
   {
        // $query=User::when(isset($data['user_id']), function ($query) use ($data) {
        //     return $query->where('userable_type', Admin::class);
        // })->with($withes)->latest();
        // if ($paginated)
        //     return $query->paginate();
        // return $query->get();
       $query=User::where('userable_type', Admin::class)->get();
       return $query;


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

