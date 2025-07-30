<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'min:10']
        ];
    }
}
