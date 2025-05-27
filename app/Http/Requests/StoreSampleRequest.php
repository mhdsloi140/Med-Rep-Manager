<?php

namespace App\Http\Requests;

use App\Models\Sample;
use Illuminate\Foundation\Http\FormRequest;

class StoreSampleRequest extends FormRequest
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


        $validation = array();
        $available_locales = config('app.available_locales');
        $translatedFields = Sample::getTranslatedFields();
        foreach ($available_locales as $index => $locale) {
            $validation[$locale] = ['required', 'array'];
            foreach ($translatedFields as $translatedField) {
                $validation["$locale.$translatedField"] = ['required', 'string', 'max:255'];

            }
        }


        return array_merge($validation, [
            'company_id' => ['required', 'numeric', 'exists:companies,id'],
            'quantity' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png','max:2048'],
        ]);


    }
    public function afterValidate()
    {
        $data=$this->validated();
        return $data;
    }
}
