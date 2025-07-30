<?php

namespace App\Http\Requests\Answer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnswerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'generate_new_distractors' => ['sometimes','boolean'],
            'answer' => ['required', 'string', 'min:3'],
            'question_id' => ['required', 'integer']
        ];
    }
}
