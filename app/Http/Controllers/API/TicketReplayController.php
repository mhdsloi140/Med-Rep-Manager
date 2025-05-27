<?php

namespace App\Http\Controllers\API;

use App\Events\TicketReplyCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketReplayRequest;
use App\Http\Resources\TictetReplayResource;
use App\Services\TicketReplayService;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class TicketReplayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private TicketReplayService $ticketReplayService)
    {

    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketReplayRequest $request)
    {

        // $data=$request->aftreValidation();

        $data=$request->aftreValidation();
        $ticket_reply=$this->ticketReplayService->store($data);
        broadcast(new TicketReplyCreated($ticket_reply))->toOthers();
        return $this->response(TictetReplayResource::make($ticket_reply));

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
