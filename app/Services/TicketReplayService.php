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

class TicketReplayService
{

    public function all($data = [], $paginated = true, $withes = [])
   {

           $ticket_repaly=TicketReply::find($data['ticket_id'])->first();
           return $ticket_repaly;


    }

    public function store($data ): TicketReply
    {
        $tickrtes = TicketReply::create($data);
        return $tickrtes;
    }

}

