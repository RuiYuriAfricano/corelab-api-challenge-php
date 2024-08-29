<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TodoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Regras de validação para o método `store` (campos obrigatórios)
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'isFavorite' => 'boolean',
            'color' => 'string|regex:/^#[0-9A-Fa-f]{6}$/',
        ];

        // Para o método `update`, os campos são opcionais
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['title'] = 'nullable|string|max:255';
            $rules['content'] = 'nullable|string';
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
