<?php

namespace App\Http\Requests;

use App\Models\Delegate;
use Illuminate\Foundation\Http\FormRequest;

class IndexTicketRequest extends FormRequest
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
            //
        ];
    }

    public function afterValidation()
    {
        $data = $this->validated();
        $user = auth()->user();
        if($user->userable instanceof Delegate){
            $data['delegate_id'] = $user->userable_id;
        }
        return $data;
    }

}
