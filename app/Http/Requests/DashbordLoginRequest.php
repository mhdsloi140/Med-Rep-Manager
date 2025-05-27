<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\ValidationException;

use Hash;
use Illuminate\Foundation\Http\FormRequest;

class DashbordLoginRequest extends FormRequest
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
            'email' =>['required','email','exists:users,email'],
            'password'=>['required']
        ];
    }

    public function afterValidation()
    {
        $data=$this->validated();
        $user = User::where('email', $data['email'])->first();
      
        if(!Hash::check($data['password'], $user->password)){
            throw ValidationException::withMessages([
                'password' => 'Incorrect Password or Email.',
            ]);
        }

        return $data;
    }
}
