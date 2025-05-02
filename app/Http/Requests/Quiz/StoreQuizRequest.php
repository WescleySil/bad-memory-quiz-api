<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'string', 'min:3'],
            'questions_count' => ['required', 'integer','min:1'],
        ];
    }
}
