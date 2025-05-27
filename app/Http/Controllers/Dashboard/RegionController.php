<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRegionRequest;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdaeRegionRequest;
use App\Models\City;
use App\Models\Region;
use App\Services\RegionService;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function __construct(private RegionService $regionService)
     {

     }
    public function index(IndexRegionRequest  $request ,$search =null)
    {
        $data=$request->afterValidation();
        $regions=$this->regionService->all(data:$data ,paginated:false);
        $cities=City::all();
        return view('region.index',compact('regions','cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $cities=City::all();
        return view('region.create',compact('cities'));
    }
    public function store(StoreRegionRequest $request)
    {
        $data=$request->afterValidation();
        $region=$this->regionService->store($data);
        return redirect()->route('region.index')->with('success',__('locale.region_created'));
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $region=Region::where('id','=',$id)->first();
        $cities=City::all();
        return view('region.edit',compact('region','cities'));
    }
    public function show(string $id)
    {
        //
    }
    public function getByCity($city_id)
    {
        $areas = Region::where('city_id', $city_id)->get();
        return response()->json($areas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdaeRegionRequest $request, string $id)
    {
        $data=$request->afterValidation();
     
        $region=$this->regionService->update($data,$id);
        return redirect()->route('region.index')->with('success',__('locale.region_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $region=Region::find($id);
        $region->delete();
        return redirect()->route('region.index')->with('success',__('locale.region_deleted'));
    }
}
