<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'date' => 'required|date|before_or_equal:today',
            'city' => 'required|string|max:255',
            'cf' => 'required|alpha_num|size:16',
            'ts' => 'nullable|numeric|max:20',
            'expiry' => 'nullable|date|after:today',
            'address' => 'required|string|max:255',
            'cap' => 'required|numeric',
            'phone' => 'required|numeric',
            'email' => 'nullable|email|regex:/.*@.*/',
            'consent' => 'required|accepted',
        ];
    }
    public function messages()
    {
        return [
            "surname" => [
                'required' => "Il cognome è obbligatorio",
                'max' => "Puoi utilizzare un massimo di :max caratteri",
            ],
            "name" => [
                'required' => "Il nome è obbligatorio",
                'max' => "Puoi utilizzare un massimo di :max caratteri",
            ],
            "date" => [
                'required' => "La data è obbligatoria",
                'before_or_equal' => "La data non può essere futura",
            ],
            "city" => "Il comune di nascita è obbligatorio",
            "cf" => [
                'required' => "Il codice fiscale è obbligatorio",
                'alpha_num' => "Il codice fiscale può contenere solo numeri e lettere",
                'size' => "Il codice fiscale deve essere esattamente di :size caratteri",
            ],
            "ts" => [
                'numeric' => "La tessera sanitaria può contenere solo numeri",
                'max' => "Puoi utilizzare un massimo di :max caratteri",
            ],
            "expiry" => [
                'after' => "La data non può essere passata",
            ],
            "address" => [
                'required' => "L indirizzo di residenza è obbligatorio",
                'max' => "Puoi utilizzare un massimo di :max caratteri",
            ],
            "cap" => [
                'required' => "Il CAP è obbligatorio",
                'numeric' => "Il CAP può contenere solo numeri",
                'size' => "Il CAP deve essere esattamente di :size caratteri",
            ],
            "phone" => [
                'required' => "Il numero di telefono è obbligatorio",
                'numeric' => "Il numero di telefono può contenere solo numeri",
                'size' => "Il numero di telefono deve essere esattamente di :size caratteri",
            ],
            "email" => [
                'email' => "Inserisci un indirizzo email valido",
                'regex' => "L indirizzo email deve contenere il simbolo @"
            ],
            "consent" => [
                'required' => "Devi accettare i termini e le condizioni",
                'boolean' => "Il campo deve essere spuntato",
                'accepted' => "Devi accettare i termini e le condizioni",
            ],
        ];
    }
}
