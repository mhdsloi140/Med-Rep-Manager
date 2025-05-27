<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexVistiRequest;
use App\Http\Requests\StoreVistiRequest;
use App\Http\Requests\UpataStatusRequest;
use App\Models\City;
use App\Models\Delegate;
use App\Models\Doctor;
use App\Models\Region;
use App\Models\Visti;
use App\Models\VistiSample;
use App\Services\VistiService;
use Illuminate\Http\Request;

class VistiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(  protected VistiService $vistiService)
    {

    }
    public function index(IndexVistiRequest $request)
    {
        $data=$request->aftreValidation();
        $visits=$this->vistiService->all(data:$data);

       $datasearch=$this->vistiService->index();


        return view('visti.index',compact('visits'),$datasearch);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVistiRequest $request)
    {
        $data=$request->afterValidation();
        $visti=$this->vistiService->store($data);
        return redirect()->route('visit.index')->with('success',__('locale.visti_created'));


    }

    /**
     * Display the specified resource.
     */
    public function create()
    {
        $data=$this->vistiService->create();
        return view('visti.create',$data);
    }
    public function show(string $id)
     {
        $vistis = Visti::with('samples')->find($id);
         $samples = VistiSample::where('visti_id', $id)->get();



        return view('visti.show',compact('vistis' ,'samples'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($id)
    {
        return view('visit.edit',compact(''));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visti=Visti::find($id);
        $visti->delete();
        return redirect()->route('visit.index')->with(['success'=>'Delete Visit Successfully']);
    }
    public function update_visti(UpataStatusRequest $request, string $id)
    {
        $data=$request->validated();
       $visti=$this->vistiService->update_visti($data,$id);
       return redirect()->route('visit.index');

    }
}
