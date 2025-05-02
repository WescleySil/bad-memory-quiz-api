<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'min:3'],
            'description' => ['nullable', 'string', 'min:3'],
            'questions_count' => ['nullable', 'integer'],
        ];
    }
}
