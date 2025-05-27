<?php

namespace App\Http\Requests;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
        $translatedFields = City::getTranslatedFields();
        foreach ($available_locales as $index => $locale) {
            $validation[$locale] = ['required', 'array'];
            foreach ($translatedFields as $translatedField) {
                $validation["$locale.$translatedField"] = ['required', 'string', 'max:255'];
                // if(config('translatable.fallback_locale') == $locale) {
                //     $validation["$locale.$translatedField"][] = 'required';
                // }
            }
        }
        return $validation;
    }
}
