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
use Storage;

class DoctorService
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

        $doctor = Doctor::create($data);

        if (isset($data['image'])) {
            $image = $data['image'];
            $path = $image->store("samples/{$doctor->id}", 'public');
            $doctor->update(['image' => $path]);

        }
        return $doctor;

    }
    public function show($id)
    {
        $doctor = Doctor::with('region')->findOrFail($id);
         $vistis = Visti::where('doctor_id', $id)->where('status', VisitsStatusEnum::DONE->value)
         ->get();
         if(!auth()->user()->userable instanceof Delegate){
             $comments=DoctorComment::where('doctor_id', $id)->get();
         }
         return [
            'doctor'=>$doctor,
            'vistis'=>$vistis,
            'comments'=>$comments
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

        $doctor=Doctor::findOrFail($id);
        $updateData = Arr::except($data, ['image']);

        if (!empty($data['image'])) {
            if ($doctor->image && Storage::disk('public')->exists($doctor->image)) {
                Storage::disk('public')->delete($doctor->image);
            }

            $image = $data['image'];
            $path = $image->store("samples/{$doctor->id}", 'public');
            $updateData['image'] = $path;
        }
        $doctor->update($updateData);


        return $doctor;

    }

    public function restore($id)
    {
        return Doctor::withTrashed()->find($id)->restore();
    }


}

