<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Events\TicketEvent;
use App\Models\DelegateSupervisor;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Arr;
use Auth;

class TicketService
{

    public function all($data = [], $paginated = true, $withes = [])
   {

    return Ticket::with($withes)->when(isset($data['delegate_id']), function($query)use($data){
        $query->where('delegate_id', $data['delegate_id']);
    })->when($paginated, function($query){
        return $query->paginate();
    }, function($query){
        return $query->get();
    });


    }

    public function store($data): Ticket
    {
        $tickrtes = Ticket::create($data);
        // $user=User::where('id',$data['delegate_id']);

        // event(new TicketEvent($tickrtes));
        return $tickrtes;
    }
    public function show($id, $withes)
    {
        return Ticket::with($withes)->findOrFail($id);
    }
    // public function show (string $id)
    // {
    //       $data=Ticket::where('id',$id)->get();
    //       dd($data['delegate_id']);
    //       if ($data['delegate_id']!== Auth::id() && !Auth::user()->userable instanceof Admin) {
    //         abort(403, 'غير مصرح لك بعرض هذه التذكرة.');
    //     }
    //      return $data;
    // }

}

