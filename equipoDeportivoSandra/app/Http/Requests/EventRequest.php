<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'hour' => 'required|date_format:Y-m-d H:i:s',
            'type' => 'required|in:official,exhibition,charity',
            'tags' => 'required',
        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'location.required' => 'La ubicación es obligatoria.',
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha debe ser una fecha válida.',
            'hour.required' => 'La fecha y hora son obligatorias.',
            'hour.date_format' => 'El formato debe ser YYYY-MM-DD HH:MM:SS.',
            'type.required' => 'El tipo es obligatorio.',
            'type.in' => 'El tipo debe ser uno de los siguientes: official, exhibition, charity.',
            'tags.required' => 'Los tags son obligatorios.',
        ];
    }

}
