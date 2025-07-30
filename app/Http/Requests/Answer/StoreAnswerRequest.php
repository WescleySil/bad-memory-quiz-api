<?php

namespace App\Http\Requests\Answer;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'answer' => ['required', 'string', 'min:3'],
            'question_id' => ['required', 'integer', 'exists:questions,id'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $question = Question::where('id', $this->question_id)->first();
            if($question){
                if($question->answers){
                    if($question->answers->count() > 1) {
                        $validator->errors()->add('question_id', 'Esta pergunta já possui o número máximo de respostas permitidas');
                    }
                }
            } else {
                $validator->errors()->add('question_id', 'A pergunta não foi encontrada');
            }
        });
    }
}
