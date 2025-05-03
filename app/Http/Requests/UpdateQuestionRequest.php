<?php

namespace App\Http\Requests;

use App\Models\Question;
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
