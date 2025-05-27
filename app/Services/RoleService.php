<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Enums\VisitsStatusEnum;
use App\Models\City;
use App\Models\Delegate;
use App\Models\DelegateSupervisor;
use App\Models\Doctor;
use App\Models\DoctorComment;
use App\Models\Region;
use App\Models\User;
use App\Models\Visti;
use Arr;
use Auth;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Storage;

class RoleService
{

    public function all($data = [], $paginated = true, $withes = [])
   {

  if(auth()->user()->userable instanceof Delegate){
    $delegateId = auth()->user()->userable->id;

     $query = Doctor::where('delegate_id', $delegateId);
     return $paginated ? $query->paginate() : $query->get();
    }
    else
    {

    return Doctor::withTrashed()->with($withes)->when(isset($data['delegate_id']), function($query)use($data){
        $query->where('delegate_id', $data['delegate_id']);
    })->when($paginated, function($query){
        return $query->paginate();
    }, function($query){
        return $query->get();
    });
    }



    }

    public function create()
    {
         $cities=City::get();
         $regions=Region::get();
         $delegates=Delegate::get();
         return [
            'cities'=>$cities,
            'regions'=>$regions,
            'delegates'=>$delegates

         ];

    }

    public function store($data)
    {

        $role = Role::create(['name' => $data['name']]);

      if (isset($data['permissions'])) {
        $role->syncPermissions($data['permissions']);
    }

        return $role;

    }
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
         ->where("role_has_permissions.role_id",$id)->get();
         return[
            'role'=>$role,
            'rolePermissions'=>$rolePermissions
         ];

    }
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
         ->all();
         return[
            'role'=>$role,
            'permission'=>$permission,
            'rolePermissions'=>$rolePermissions
         ];
    }
    public function destroy($id)
    {
        $doctor = Doctor::withTrashed()->find($id);
        if ($doctor->deleted_at)
            $deleted = $doctor->restore();
        else
            $deleted = $doctor->delete();
        return $deleted;

    }
    public function  update($data,$id)
    {

       $role=Role::findOrFail($id);
       $role->name = $data['name'];
      $role->save();
      $validPermissionIds = Permission::whereIn('id', $data['permission'])->pluck('id')->toArray();
    $role->syncPermissions($validPermissionIds);


        return $role;

    }

    public function restore($id)
    {
        return Doctor::withTrashed()->find($id)->restore();
    }


}

