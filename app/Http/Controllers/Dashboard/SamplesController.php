<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexSmpaleRequest;
use App\Http\Requests\StoreSampleRequest;
use App\Http\Requests\StoreSamplesRequest;
use App\Http\Requests\UpateSampleRequiest;
use App\Models\Company;
use App\Models\Sample;
use App\Services\SamplesService;
use Illuminate\Http\Request;

class SamplesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected SamplesService $samplesService)
    {

    }
    public function index(IndexSmpaleRequest $request ,$search =null)
    {
        $data = $request->validated();
        $samples=$this->samplesService->all(data: $data);

        return view('sample.index' ,compact('samples'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $companies=Company::get();
        return view('sample.create',compact('companies'));
    }
    public function store(StoreSampleRequest $request)
    {
        $data = $request->validated();
        $smaple=$this->samplesService->store($data);
        // $sample = Sample::create($data);
        return redirect()->route('sample.index')->with('success', 'تم إنشاء العينة بنجاح ');
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
    public function edit($id)
    {
        $sample=Sample::where('id','=',$id)->first();
  
        $companies=Company::get();
        return view('sample.edit',compact('sample','companies'));
    }
    public function update(UpateSampleRequiest $request, string $id)
    {
        $data = $request->afterValidation();
        $sample=$this->samplesService->update($data,$id);
        return redirect()->route('sample.index')->with('success', 'تم تعديل العينة بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
