<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Enums\VisitsStatusEnum;
use App\Models\Delegate;
use App\Models\DelegateSupervisor;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Visti;
use Arr;
use Carbon\Carbon;
use Storage;

class DashboardService
{

    public function index()
    {
        $totalVisits = Visti::where('status', VisitsStatusEnum::DONE->value)->count();
        $dailyVisits = Visti::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date')
        ->get();
        $visitsPerDoctor = Visti::selectRaw('doctor_id, COUNT(*) as total')->groupBy('doctor_id')->with('doctor')
        ->get();
       $doctor=Doctor::get()->count();
       $delegate=Delegate::get()->count();
       $supervisor=DelegateSupervisor::get()->count();

       $labels = [];
       $counts = [];
       $percentages = [];
      $totalLast7Days = $dailyVisits->sum('count');
    foreach ($dailyVisits as $visit) {
        $labels[] = Carbon::parse($visit->date)->format('d M');
        $counts[] = $visit->count;
        $percentages[] = $totalLast7Days ? round(($visit->count / $totalLast7Days) * 100, 2) : 0;
    }
    if (auth()->user()->userable_type === Delegate::class) {
        $vistidelegatetoday = Visti::where('delegate_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())
            ->count();
         $delegateId=auth()->user()->userable->id;   
         $doctorcount=Doctor::where('delegate_id', $delegateId)->count();  
         $vistidone=Visti::where('delegate_id', $delegateId)->where('status', VisitsStatusEnum::DONE->value)->count();


    }
    else
    {
        $vistidelegatetoday=0;
        $doctorcount=0;
        $vistidone=0;
    }
    return [
        'totalVisits' => $totalVisits,
        'labels' => $labels,
        'counts' => $counts,
        'percentages' => $percentages,
        'visitsPerDoctor' => $visitsPerDoctor,
        'doctor' => $doctor,
        'delegate' => $delegate,
        'supervisor' => $supervisor,
        'vistidelegatetoday'=>$vistidelegatetoday,
        'doctorcount'=>$doctorcount,
        'vistidone'=>$vistidone
    ];
    }

    public function all($data = [], $paginated = true, $withes = [])
   {


    return Doctor::withTrashed()->with($withes)->when(isset($data['delegate_id']), function($query)use($data){
        $query->where('delegate_id', $data['delegate_id']);
    })->when($paginated, function($query){
        return $query->paginate();
    }, function($query){
        return $query->get();
    });


    }

    // public function create()
    // {
    //     $delegate=Delegate::get();
    // }

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

