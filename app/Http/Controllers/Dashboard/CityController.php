<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CiteStoreRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Http\Request;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities=City::get();
        return view('city.index',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('city.create');
    }
    public function store(StoreCityRequest $request)
    {
        $data=$request->validated();
        $city=City::create($data);
        return redirect()->route('city.index')->with('success',__('locale.city_created'));
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
    public function edit(string $id)
    {
        $city=City::find($id);
        return view('city.edit',compact('city'));
    }
    public function update(UpdateCityRequest $request, string $id)
    {
        $data=$request->validated();
        $city=City::find($id);
        $city->update($data);
        return redirect()->route('city.index')->with('success',__('locale.city_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city=City::find($id);
        $city->delete();
        return redirect()->route('city.index')->with('success',__('locale.city_deleted'));
    }
}
