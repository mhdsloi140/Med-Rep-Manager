<?php

namespace App\Http\Requests;

use App\Models\Region;
use Illuminate\Foundation\Http\FormRequest;

class StoreRegionRequest extends FormRequest
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
        $translatedFields = Region::getTranslatedFields();
        foreach ($available_locales as $index => $locale) {
            $validation[$locale] = ['required', 'array'];
            foreach ($translatedFields as $translatedField) {
                $validation["$locale.$translatedField"] = ['required', 'string', 'max:255'];

            }
        }
        return array_merge($validation, [
            'city_id' => ['required', 'numeric', 'exists:cities,id'],
        ]);
    }

    public function afterValidation()
    {
        $data=$this->validated();
        return $data;
    }
}
