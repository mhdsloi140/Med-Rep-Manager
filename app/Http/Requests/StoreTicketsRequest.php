<?php

namespace App\Http\Requests;

use App\Enums\TicketableEnum;
use App\Rules\TicketableExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTicketsRequest extends FormRequest
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

        // dd(auth()->user()->id);
        return [
            'title'=>['required','string','max:255'],
            'description' => ['required', 'string', 'max:65000'],
            'ticketable_type' => ['nullable', Rule::in(array_column(TicketableEnum::cases(), 'name'))],
            'ticketable_id' => ['required_with:ticketable_type', new TicketableExistsRule($this->ticketable_type)]
        ];
    }
    public function aftreValidation()
    {
        $data = $this->validated();
        $data['delegate_id'] = auth()->user()->userable_id;
        $data['ticketable_type'] = TicketableEnum::fromName($data['ticketable_type'])->value;
        return $data;
    }
}
