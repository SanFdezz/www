<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'twitter' => 'required',
            'instagram' => 'required',
            'twitch' => 'required',
            'avatar' => 'nullable',
            'age' => 'required|integer|min:15|max:45',
            'position' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto.',
            'name.max' => 'El nombre debe tener como máximo 30 carácteres.',
            'twitter.required' => 'La cuenta de Twitter es obligatoria.',
            'instagram.required' => 'La cuenta de Instagram es obligatoria.',
            'twitch.required' => 'La cuenta de Twitch es obligatoria.',
            'age.required' => 'La edad es obligatoria.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad mínima permitida es 15 años.',
            'age.max' => 'La edad máxima permitida es 45 años.',
            'position.required' => 'La posición es obligatoria.',
            'position.string' => 'La posición debe ser un texto.',
        ];
    }

}
