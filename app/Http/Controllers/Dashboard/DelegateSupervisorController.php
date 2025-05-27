<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DelegateSupervisorRequest;
use App\Http\Requests\DelegateSupervisorStoreRequest;
use App\Services\DelegateSupervisorService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DelegateSupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected DelegateSupervisorService $delegateSupervisor)
    {

    }
    public function index()
    {
        $supervisors=$this->delegateSupervisor->all();
        return view('admin.delegatesupervisor.index', compact('supervisors'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
          $roles=Role::pluck('name','name')->all();

        return view('admin.delegatesupervisor.create',compact('roles'));
    }
    public function store(DelegateSupervisorStoreRequest $request)
    {
        $data=$request->validated();
        $supervisors=$this->delegateSupervisor->store($data);
        return redirect()->route('delegateSupervisor.index')->with('success',__( 'locale.created_delegatesupervisor'));
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
