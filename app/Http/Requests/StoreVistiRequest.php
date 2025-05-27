<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVistiRequest extends FormRequest
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
            'doctor_id'=>['required','numeric','exists:doctors,id'],
            'delegate_id'=>['required','numeric','exists:delegates,id'],
            'region_id'=>['required','numeric','exists:regions,id'],
            'sample_ids' => ['nullable', 'array'],
            'note'=>['nullable','string'],
            'sample_quantities' => ['nullable', 'array'],
            'sample_notes' => ['nullable', 'array'],
            'visit_date'=>['required','date'],
            'visti_time'=>['required','date_format:H:i'],
        ];
    }
    public function afterValidation()
    {
        $data=$this->validated();
        return $data;
    }
}
