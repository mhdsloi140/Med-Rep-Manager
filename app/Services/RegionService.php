<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Models\Company;
use App\Models\DelegateSupervisor;
use App\Models\Region;
use App\Models\Sample;
use App\Models\User;
use App\Models\Visti;
use Arr;

class RegionService
{

    public function all($data = [], $paginated = true, $withes = [])
    {
        $query = Region::when(isset($data['search']), function ($query) use ($data) {
            return $query->whereHas('translations', function ($q) use ($data) {
                $q->where('name', 'like', "%{$data['search']}%");
            });
        })->when(isset($data['city_id']), function ($query) use ($data) {
            return $query->where('city_id', $data['city_id']);
        });
        if($paginated)
        return $query->paginate();

        return $query->get();




    }

    public function store($data)
    {

        $region = Region::create($data);
        return $region;
    }
    public function update($data, $id)
    {

        $region = Region::find($id);
        $region->update($data);
        return $region;

    }


}

