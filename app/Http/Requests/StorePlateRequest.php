<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlateRequest extends FormRequest
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
            'name' => 'required|max:255|min:3|string',
            'description' => 'nullable|string|max:255|min:3',
            'visibility' => 'boolean',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Il nome è obbligatorio',
            'name.min' => 'Il nome deve avere almeno 3 caratteri',
            'name.max' => 'Il nome deve avere massimo 255 caratteri',
            'name.string' => 'Il nome deve essere una stringa',

            'description.string' => 'La descrizione deve essere una stringa',
            'description.max' => 'La descrizione deve avere massimo 255 caratteri',
            'description.min' => 'La descrizione deve avere almeno 3 caratteri',

            'image.image' => 'L\'immagine deve essere un\'immagine',
            'image.max' => 'L\'immagine deve avere massimo 2048 kilobyte',
            
            'price.required' => 'Il prezzo è obbligatorio',
            'price.numeric' => 'Il prezzo deve essere un numero',
            'price.min' => 'Il prezzo deve essere positivo',

        ];
    }
}
