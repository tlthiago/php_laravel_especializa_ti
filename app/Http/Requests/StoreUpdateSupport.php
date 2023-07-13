<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSupport extends FormRequest
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
        $rules = [
            // Nome do método e string separada por | com validações ou um array
            'subject' => 'required | min: 3 | max: 255 | unique:supports',
            'body' => [
            'required',
            'min: 3',
            'max: 100000'
            ]
        ];

        if ($this->method() === "PUT") {
            $rules['subject'] = [
                'required',
                'min: 3',
                'max: 255',
                // Ele é unico na tabela supports. Porém pode adicionar uma exceção quando o id que estou recebendo for igual da coluna id
                Rule::unique('supports')->ignore($this->id)

                // Aternativa
                // "unique:supports, subject, {$this->id}, id"
            ];
        }

        return $rules;
    }
}
