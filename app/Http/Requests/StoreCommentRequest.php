<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Auth;
use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'doctor_id' => ['required','numeric','exists:doctors,id'],
            'comment' => ['required','string','max:6500'],
        ];
    }
    public function afterValidation()
    {
        $data=$this->validated();
        $doctor=Doctor::find($data['doctor_id']);
        //  if(!auth()->user()->userable instanceof Delegate){
        //     abort(403, 'غير مصرح لك بالتعليق.');
        //   }
    //   $delegate_id=auth()->user()->userable->id;
    //   dd($delegate_id);
        if ( $doctor->delegate_id !== auth()->user()->userable->id) {

           abort(403, 'لا يمكنك التعليق على هذا الطبيب.');
          }
          $data['delegate_id']=auth()->user()->userable->id;
        return $data;
    }
}
