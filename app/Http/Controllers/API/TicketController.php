<?php

namespace App\Http\Controllers\API;

use App\Events\TicketEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\StoreTicketsRequest;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{

     public function __construct(private TicketService $ticketService)
     {

     }
    /**
     * Display a listing of the resource.
     */
    public function index(IndexTicketRequest $request)
    {
        $data=$request->afterValidation();


        $tickets=$this->ticketService->all(data: $data);
        return $this->response(data: TicketResource::collection($tickets));


        // $tickets = $this->ticketService->all(data: $date);

        // return $this->response(data: TicketResource::collection($tickets));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketsRequest $request)
    {


        $data=$request->aftreValidation();
        // dd($data);
        $tickrtes=$this->ticketService->store($data);
       
         return $this->response(TicketResource::make($tickrtes));



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
