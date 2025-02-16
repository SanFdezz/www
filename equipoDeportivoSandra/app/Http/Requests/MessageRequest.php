<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'subject' => 'required',
            'text' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'subject.required'=>'Es necesario que haya un sujeto/título.',
            'text.required'=>'Es necesario que haya un contenido en el mensaje.'
        ];
    }
}
