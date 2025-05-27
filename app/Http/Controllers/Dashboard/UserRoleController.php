<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreRolePermissionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('users.assign-role', compact('users', 'roles', 'permissions'));
    }
    public function store(StoreRolePermissionRequest $request)
    {

    $data = $request->validated();
    // dd($data);

    $user = User::findOrFail($data['user_id']);

    // إسناد الدور
    $role = Role::findOrFail($data['role']);
    $user->assignRole($role->name);
    // dd($data['role']);

   if (!empty($data['permission'])) {
        $user->givePermissionTo($data['permission']);
        

    }
        return redirect()->route('dashboard.index')->with('success', 'تم إسناد الدور والصلاحية للمستخدم بنجاح.');

    }

}
