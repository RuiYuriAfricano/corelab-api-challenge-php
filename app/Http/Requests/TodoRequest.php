<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TodoRequest extends FormRequest
{
    public function authorize()
    {
        // Autoriza todos os usuários a fazer esta requisição. Altere conforme necessário.
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'isFavorite' => 'boolean',
            'color' => 'string|regex:/^#[0-9A-Fa-f]{6}$/',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Lança uma exceção com os erros de validação em formato JSON
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
