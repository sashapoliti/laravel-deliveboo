<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class StoreRegisterUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults() , 'min:8' , 'max:255'],
            'address' => 'required|string|max:255|min:3',
            'vat_number' => 'required|string|max:11|min:11',
            'restaurant_name' => 'required|max:255|min:3|string',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:255|min:3',
            'logo' => 'nullable|image|max:2048',
            'types' => 'required|array|min:1',
            'types.*' => 'exists:types,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'address.required' => 'L\'indirizzo è obbligatorio',
            'address.min' => 'L\'indirizzo deve avere almeno 3 caratteri',
            'address.max' => 'L\'indirizzo deve avere massimo 255 caratteri',
            'address.string' => 'L\'indirizzo deve essere una stringa',
    
            'vat_number.required' => 'Il numero di partita IVA è obbligatorio',
            'vat_number.min' => 'Il numero di partita IVA deve avere almeno 11 caratteri',
            'vat_number.max' => 'Il numero di partita IVA deve avere massimo 11 caratteri',
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

            'types.required' => 'Seleziona almeno un tipo di ristorante',
            'types.*.exists' => 'Il tipo di ristorante selezionato non è valido',

            'restaurant_name.required' => 'Il nome del ristorante è obbligatorio',
            'restaurant_name.min' => 'Il nome del ristorante deve avere almeno 3 caratteri',
            'restaurant_name.max' => 'Il nome del ristorante deve avere massimo 255 caratteri',
            
            'password.confirmed' => 'La conferma della password non corrisponde',
            'password.required' => 'La password è obbligatoria',
            'password.min' => 'La password deve avere almeno 8 caratteri',
            'password.max' => 'La password deve avere massimo 255 caratteri',
        ];
    }
}
