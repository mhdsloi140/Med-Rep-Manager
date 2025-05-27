<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\RoleService;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function __construct(protected RoleService $roleService)
{
    // $this->middleware('permission:view_role|create_role|update_role|delete_role', ['only' => ['index','store']]);
    // $this->middleware('permission:create_role', ['only' => ['create','store']]);
    // $this->middleware('permission:update_role', ['only' => ['edit','update']]);
    // $this->middleware('permission:delete_role', ['only' => ['destroy']]);
}
    public function index(Request $request)
    {
      $roles = Role::orderBy('id','DESC')->paginate(5);
      return view('roles.index',compact('roles'))
      ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
           $permissions = Permission::all(); // عرض كل الصلاحيات
           return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $data=$request->validated();
        $role=$this->roleService->store($data);
        return redirect()->route('roles.index')->with('success', 'تم إنشاء الدور بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=$this->roleService->show($id);
      return view('roles.show',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(string $id)
    {
        $data=$this->roleService->edit($id);
       return view('roles.edit',$data);
    }
    public function update(UpdateRoleRequest $request, string $id)
    {
       $data = $request->validated();
       $role=$this->roleService->update($data,$id);
       return redirect()->route('roles.index')->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
