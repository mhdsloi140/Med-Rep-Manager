<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\NewTicketEvent;
use App\Events\TicketReplayEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexTicketRequest;
use App\Http\Requests\StoreTicketReplayRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Admin;
use App\Models\Ticket;
use App\Services\TicketReplayService;
use App\Services\TicketService;
use Auth;
use Illuminate\Http\Request;

class TicekController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct(protected TicketService $ticketService)
     {

     }
    public function index(IndexTicketRequest $request)
    {
        $data=$request->afterValidation();
        $tickets=$this->ticketService->all(data:$data);

        return view('ticket.index',compact('tickets'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('ticket.create');
    }
    public function store(StoreTicketRequest $request)
    {
         $data=$request->afterValidation();

         $ticket=$this->ticketService->store($data);
         broadcast(new NewTicketEvent($ticket));

         return redirect()->route('tickets.index')->with(['success'=>'Tiket Create Successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $data=Ticket::where('id',$id)->get();
        // dd($data);
        // $ticket=$this->ticketService->show($id);
        $ticket = $this->ticketService->show(id: $id, withes: ['ticketReplies']);
        


        return view('ticket.show', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    // public function updateStatus(Request $request, Ticket $ticket)
    // {
    //     // مثال بسيط لتحديث الحالة (يجب إضافة صلاحيات أكثر دقة)
    //     if (Auth::user()->is_admin) {
    //         $request->validate([
    //             'status' => 'required|in:open,in_progress,closed',
    //         ]);
    //         $ticket->update(['status' => $request->status]);
    //         return redirect()->route('tickets.show', $ticket->id)->with('success', 'تم تحديث حالة التذكرة.');
    //     }
    //     abort(403, 'غير مصرح لك بتحديث حالة هذه التذكرة.');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
