<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
//    dd($this->all());
        return [
            'name'=>['required','string','max:255'],
            'phone'=>['required','string','min:10'],
            'city_id'=>['required','numeric','exists:cities,id'],
            'region_id'=>['required','numeric','exists:regions,id'],
            'latitude' => ['required','numeric','between:-90,90'],
            'longitude' => ['required','numeric','between:-180,180'],
            'delegate_id'=>['required','numeric','exists:users,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png','max:2048'],

        ];
    }
    public function afterValidation()
    {
        $data=$this->validated();
        return $data;
    }
}
