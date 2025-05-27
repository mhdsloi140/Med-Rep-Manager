<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'=>['nullable','string','max:255'],
            'phone'=>['nullable','string','max:10'],
            'password'=>['nullable','string','min:8'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png','max:2048'],
            'email' => ['nullable', 'email', 'unique:users,email,' .auth()->user()->id],
        ];
    }
    public function afterValidation()
    {
        $data=$this->validated();
        return $data;
    }
}
