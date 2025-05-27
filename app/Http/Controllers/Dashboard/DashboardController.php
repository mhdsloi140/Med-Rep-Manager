<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\VisitsStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\DelegateSupervisor;
use App\Models\Doctor;
use App\Models\Visti;
use App\Services\DashboardService;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private DashboardService $dashboardService)
    {

    }
    public function index()
    {

     $data=$this->dashboardService->index();
    // dd($data);
    return view('dashboard.index', $data);
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
        //
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
