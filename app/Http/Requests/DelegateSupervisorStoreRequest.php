<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DelegateSupervisorStoreRequest extends FormRequest
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
            'name'=>['required','string','max:255'],
            'email'=>['required','email','unique:users,email'],
            // 'password'=>['required','string',],
            'phone'=>['nullable','string','max:10'],
             'roles' =>[ 'nullable','array'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png','max:2048'],
        ];
    }
    public function afterValidation(){
        $data=$this->validated();
        return $data;
    }
}
