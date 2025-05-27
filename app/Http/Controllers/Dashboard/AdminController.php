<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateRequest;
use App\Models\Admin;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct( protected AdminService $adminService){

     }
    public function index()
    {
        $admins = $this->adminService->all();
        return view('admin.admin.index',compact('admins'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCreateRequest $request)
    {

        $data = $request->validated();
        $admin=$this->adminService->store($data);
        return redirect()->route('admin.index',['success'=>'Admin Created ']);



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
