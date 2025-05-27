<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Models\Company;
use App\Models\DelegateSupervisor;
use App\Models\Sample;
use App\Models\User;
use App\Models\Visti;
use Arr;

class ProfileService
{

    public function all($data = [])
   {



    return User::find($data['user_id']) ;




    }

   public function store($data)
   {


   }
   public function update($data, $id)
   {
    $user = User::findOrFail($id);

    $userable = $user->userable;


    if ($userable instanceof \App\Models\DelegateSupervisor ||
        $userable instanceof \App\Models\Delegate ||
        $userable instanceof \App\Models\Admin) {


        $userable->update(Arr::except($data, ['email', 'image', 'password']));
        if (isset($data['image'])) {
            $image = $data['image'];
            $path = $image->store("samples/{$userable->id}", 'public');
            $userable->update(['image' => $path]);
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // تحديث بيانات المستخدم
        $user->update(Arr::only($data, ['email', 'name', 'password']));
    }

    return $user->fresh(); // إعادة المستخدم بعد التحديث
}



}

