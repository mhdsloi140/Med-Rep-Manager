<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Models\DelegateSupervisor;
use App\Models\User;
use Arr;
use Str;

class DelegateSupervisorService
{

    public function all($data = [], $paginated = true, $withes = [])
   {

       $query=User::where('userable_type', DelegateSupervisor::class)->get();
       return $query;


    }

   public function store($data)
   {
        $supervisors = DelegateSupervisor::create(Arr::only($data, ['name','phone']));
        $data['userable_type']='App\Models\DelegateSupervisor';
        $data['userable_id']=$supervisors->id;
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $supervisors->addMedia($data['image'])->toMediaCollection('image');
        }

        $data['password'] = bcrypt('password');
        $data['roles_name'] = $data['roles'] ?? [];
       $data['status'] = $data['status'] ?? 'active';

        $user=User::create(Arr::only($data,['email','name','password','userable_type','userable_id','roles_name','status']));
         if (isset($data['roles'])) {
                $user->syncRoles($data['roles']);
            }
        // $user=User::create($data(Arr::only()));

        return $supervisors;
   }


}

