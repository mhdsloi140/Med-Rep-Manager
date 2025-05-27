<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected CompanyService $companyService)
    {

    }
    public function index()
    {
          $companies=Company::get();
          return view('company.index',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('company.create');
    }
    public function store(StoreCompanyRequest $request)
    {
        $data=$request->afterValidation();

        $company=$this->companyService->store($data);
        return redirect()->route('company.index')->with('success',__('locale.company_created_add'));
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
         $company=Company::find($id);

        return view('company.edit',compact('company'));
    }
    public function update(UpdateCompanyRequest $request, string $id)
    {
        $data=$request->afterValidation();
        $company=$this->companyService->update($data,$id);
        return redirect()->route('company.index')->with('success',__('locale.company_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
