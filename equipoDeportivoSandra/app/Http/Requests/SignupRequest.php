<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignupRequest extends FormRequest
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
            'name' => ['required','string','unique:users'],
            'email' => ['required','string','unique:users'],
            'birthday' =>['required','date'],
            'password' => ['required','confirmed',Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'El nombre es obligatorio',
            'name.unique'     => 'El nombre debe ser único',
            'email.required'      => 'El email es obligatorio',
            'email.unique'        => 'El email debe ser único',
            'password.required'   => 'La contraseña es obligatoria',
            'password.confirmed'  => 'Las contraseñas no coinciden',
            'birthday.required' => 'EL cumpleaños es obligatorio',
        ];
    }

}
