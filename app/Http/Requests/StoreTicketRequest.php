<?php

namespace App\Http\Requests;

use App\Enums\TicketableEnum;
use App\Rules\TicketableExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTicketRequest extends FormRequest
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
        // dd($this->all());

        return [
            'title'=>['required','string','max:255'],
            'description' => ['required', 'string', 'max:65000'],

        ];

    }

    public function afterValidation()
    {
        $data = $this->validated();

        $data['delegate_id'] = auth()->user()->userable_id;
        // $data['ticketable_type'] = TicketableEnum::fromName($data['ticketable_type'])->value;
        $data['ticketable_type']=auth()->user()->userable_type;
        $data['ticketable_id']=auth()->user()->userable_id;

        return $data;
    }
}
