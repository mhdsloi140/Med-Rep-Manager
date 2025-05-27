<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Events\SendNotificationsEvent;
use App\Models\City;
use App\Models\Delegate;
use App\Models\DelegateSupervisor;
use App\Models\Doctor;
use App\Models\Region;
use App\Models\Sample;
use App\Models\User;
use App\Models\Visti;
use Arr;

class VistiService
{

    public function all($data = [], $paginated = true, $withes = [])
   {

    $query = Visti::when(isset($data['delegate_id']), function ($query) use ($data) {
        return $query->where('delegate_id', $data['delegate_id']);
    })->when(isset($data['doctor_id']), function ($query) use ($data) {
        return $query->where('doctor_id', $data['doctor_id']);
    })->when(isset($data['region_id']), function ($query) use ($data) {
        return $query->where('region_id', $data['region_id']);
    });
    if ($withes) {
        $query->with($withes);
    }
    return $paginated ? $query->paginate() : $query->get();




    }
    public function index()
    {
        $doctors=Doctor::get();
        $delegates=Delegate::get();
        $regions=Region::get();
        $cities=City::get();
        return [
            'doctors'=>$doctors,
            'delegates'=>$delegates,
            'regions'=>$regions,
            'cities'=>$cities
        ];
    }
    public function create()
    {
        $delegates=Delegate::get();
        $doctors=Doctor::get();
        $regions=Region::get();
        $samples=Sample::get();

        return [
             'delegates'=>$delegates,
             'doctors'=>$doctors,
             'regions'=>$regions,
             'samples'=>$samples
        ];
    }

    public function store($data)
    {

        $visit = Visti::create(Arr::except($data, ['sample_ids', 'sample_statuses']));
        if (!empty($data['sample_ids'])) {
            foreach ($data['sample_ids'] as $sampleId) {
                $quantity = $data['sample_quantities'][$sampleId] ?? 1;
                $note = $data['sample_notes'][$sampleId] ?? null;
                $visit->samples()->attach($sampleId, [
                    'quantity' => $quantity,
                    'note' => $note,
                    'status' => 'not_delivered',
                ]);
            }
        }
        $delegate=Delegate::find($data['delegate_id']);



        return $visit;
    }

    public function update_visti($data,$id)
    {
        $visti=Visti::find($id);

        $visti->update([
            'status'=>$data['status']
        ]);



        return $visti;
    }

}


