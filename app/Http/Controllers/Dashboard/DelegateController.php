<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DelegateStoreRequest;
use App\Jobs\CreateUserJob;
use App\Services\DelegateService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected DelegateService $delegateService)
    {

    }
    public function index()
    {
        $delegates = $this->delegateService->all();
        return view('admin.delegate.index',compact('delegates'));
     }
     public function create()
     {
        $roles=Role::pluck('name','name')->all();
         return view('admin.delegate.create' ,compact('roles'));
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DelegateStoreRequest  $request)
    {
        $data=$request->validated();
        $delegate=$this->delegateService->store($data);
        return redirect()->route('delegate.index')->with('success',__( 'locale.delegate_created'));;
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
        
        $deleted = $this->delegateService->destroy($id);
        session()->flash('success', __('locale.deleted_delegate'));
        return redirect()->back();
    }
}
