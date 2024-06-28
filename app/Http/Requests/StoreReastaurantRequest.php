<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReastaurantRequest extends FormRequest
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
            'address' => 'required|string|max:255|min:3',
            'vat_number' => 'required|string|max:255|min:3',
            'name' => 'required|max:255|min:3|string',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:255|min:3',
            'logo' => 'nullable|image|max:2048',
            'slug' => 'required|max:255|min:3|string',
        ];
    }
    public function messages()
    {
        return [
            
            'address.required' => 'L\'indirizzo è obbligatorio',
            'address.min' => 'L\'indirizzo deve avere almeno 3 caratteri',
            'address.max' => 'L\'indirizzo deve avere massimo 255 caratteri',
            'address.string' => 'L\'indirizzo deve essere una stringa',
    
            'vat_number.required' => 'Il numero di partita IVA è obbligatorio',
            'vat_number.min' => 'Il numero di partita IVA deve avere almeno 3 caratteri',
            'vat_number.max' => 'Il numero di partita IVA deve avere massimo 255 caratteri',
            'vat_number.string' => 'Il numero di partita IVA deve essere una stringa',
    
            'name.required' => 'Il nome è obbligatorio',
            'name.min' => 'Il nome deve avere almeno 3 caratteri',
            'name.max' => 'Il nome deve avere massimo 255 caratteri',
            'name.string' => 'Il nome deve essere una stringa',
    
            'image.image' => 'L\'immagine deve essere un\'immagine',
            'image.max' => 'L\'immagine deve avere massimo 2048 kilobyte',
    
            'description.string' => 'La descrizione deve essere una stringa',
            'description.max' => 'La descrizione deve avere massimo 255 caratteri',
            'description.min' => 'La descrizione deve avere almeno 3 caratteri',
    
            'logo.image' => 'Il logo deve essere un\'immagine',
            'logo.max' => 'Il logo deve avere massimo 2048 kilobyte',
    
            'slug.required' => 'Lo slug è obbligatorio',
            'slug.min' => 'Lo slug deve avere almeno 3 caratteri',
            'slug.max' => 'Lo slug deve avere massimo 255 caratteri',
            'slug.string' => 'Lo slug deve essere una stringa',

        ];
    }
}
