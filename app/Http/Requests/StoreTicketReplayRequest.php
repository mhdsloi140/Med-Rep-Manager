<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\Ticket;
use App\Models\TicketReply;
use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class StoreTicketReplayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'reply' => ['required', 'string', 'max:65000'],
            'ticket_id' => ['required', 'numeric', 'exists:tickets,id'],
        ];
    }
    public function aftreValidation()
    {
        $data=$this->validated();
        $data['user_id']=auth()->user()->id;


        $ticket = Ticket::find($data['ticket_id']);
        if (!$ticket || (!(auth()->user()->userable instanceof Admin) && $ticket->delegate_id != auth()->user()->userable_id)) {

            $erorrs=[
                'ticket_id' => 'Ticket not found',
            ];
            return $erorrs;


        }



        return $data;
    }
}
