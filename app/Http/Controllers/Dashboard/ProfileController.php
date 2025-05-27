<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Displ ay a listing of the resource.
     */
    public function __construct(private ProfileService $profileService)
    {

    }
    public function index(IndexProfileRequest $request)
    {
        $data=$request->afterValidation();

        $profiles=$this->profileService->all(data:$data);

        return view('profile.index',compact('profiles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(UpdateProfileRequest $request, string $id)
    {
       $data=$request->afterValidation();
       $this->profileService->update(data:$data,id:$id);
       return redirect()->route('dashboard.index')->with('success',__('locale.profile_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
