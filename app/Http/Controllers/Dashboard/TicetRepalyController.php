<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\TicketReplayEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexTicketReplayRequest;
use App\Http\Requests\StoreTicketReplayRequest;
use App\Models\Ticket;
use App\Services\TicketReplayService;
use Illuminate\Http\Request;

class TicetRepalyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private TicketReplayService $ticketReplayService )
    {

    }
    public function index(IndexTicketReplayRequest $request )
    {


        // $data=$request->afterValidation();
        // $replaies=$this->ticketReplayService->all($data);


        // return view('ticeketrplay.index',compact('replaies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketReplayRequest $request )
    {
        $data=$request->aftreValidation();

        $replay=$this->ticketReplayService->store($data );
        broadcast(new TicketReplayEvent($replay));
        return redirect()->route('tickets.show', $data['ticket_id'])->with('success', 'تم إضافة التعليق بنجاح.');
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
