<?php

namespace App\Http\Requests;

use App\Enums\UserableEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminCreateRequest extends FormRequest
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


             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'email', 'unique:users,email'],
            //  'ticketable_type' => ['nullable', Rule::in(array_column(UserableEnum::cases(), 'name'))],
              'phone'=>['nullable','string','max:10'],
              'password'=>['required', 'string']

        ];
    }
    public function afterValidation()
    {
        $data = $this->validated();
        // $data['user_id'] = auth()->user()->userable_id;
        // $data['userable_type'] = UserableEnum::fromName($data['userable_type'])->value;
        return $data;
    }
}
