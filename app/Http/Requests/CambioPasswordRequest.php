<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CambioPasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => 'required',
            'password' => ['required', 'min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'El campo Contraseña Actual es obligatorio.',
            'password.regex' => 'La nueva contraseña debe contener un minimo de 6 caracteres. Con al menos 1 letra Minúscula, 1 Mayúscula y 1 Número.',
            'password.confirmed' => 'El campo confirmación de contraseña no coincide.',
        ];
    }
}
