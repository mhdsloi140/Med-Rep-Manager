<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\Delegate;
use Illuminate\Foundation\Http\FormRequest;

class IndexVistiRequest extends FormRequest
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
            'doctor_id'=>['nullable','numeric','exists:doctors,id'],
            'delegate_id'=>['nullable','numeric','exists:delegates,id'],
            'region_id'=>['nullable','numeric','exists:regions,id'],
            'city_id'=>['nullable','numeric','exists:cities,id'],

        ];
    }
   public function aftreValidation()
   {
    $data=$this->validated();
    if(auth()->user()->userable instanceof Delegate)
    {
         $data['delegate_id']=auth()->user()->userable_id;
    }
    return $data;
   }
}
