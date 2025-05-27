<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\VisitsStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\City;
use App\Models\Delegate;
use App\Models\Doctor;
use App\Models\Region;
use App\Models\Visti;
use App\Services\DoctorService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private DoctorService $doctorService)
    {

    }
    public function index()
    {
        $doctors=$this->doctorService->all(paginated:true);
        $cities=City::get();
        $regions=Region::get();

        return view('doctor.index',compact('doctors','cities','regions'));

    }

    /**
     * Store a newly created resource in storage.
     */

    public function create()
    {
         $data=$this->doctorService->create();

        return view('doctor.create',$data);
    }
    public function store(StoreDoctorRequest $request)
    {

        $data=$request->afterValidation();
         $doctor=$this->doctorService->store($data);
         return redirect()->route('doctor.index')->with('success',__('locale.doctor_created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $data=$this->doctorService->show($id);

        return view('doctor.show', $data);
    }
    public function edit($id)
    {
        $doctor=Doctor::find($id);

        return view('doctor.edit',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, string $id)
    {
        $data=$request->afterValidation();
        $this->doctorService->update($data,$id);
        return redirect()->route('doctor.index')->with('success',__('locale.doctor_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->doctorService->destroy($id);
        session()->flash('message', 'Product deleted successfully.');
        return redirect()->back();
    }
}
