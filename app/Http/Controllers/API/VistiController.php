<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VistiResource;
use App\Models\Visti;
use Illuminate\Http\Request;

class VistiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function  index()
    {
          dd('ldld');
        $visits = Visti::with('doctor')->where('delegate_id', auth()->user()->userable_id)->get();
        return response()->json(VistiResource::collection($visits));
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
        // dd($id);
        $visti=Visti::find($id);
        return response()->json(VistiResource::make($visti));
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
