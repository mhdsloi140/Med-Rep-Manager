<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRegionRequest extends FormRequest
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
            'search'=>['nullable','string','max:255'],
            'city_id' => ['nullable', 'numeric', 'exists:cities,id'],


        ];
    }
    public function afterValidation()
    {
        $data=$this->validated();
        return $data;
    }
}
