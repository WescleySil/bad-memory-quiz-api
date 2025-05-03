<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class IndexQuestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filters.quiz_id' => ['nullable', 'integer', 'exists:quizzes,id'],
        ];
    }
}
