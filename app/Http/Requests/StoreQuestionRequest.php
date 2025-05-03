<?php

namespace App\Http\Requests;

use App\Models\Quiz;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'questions' => ['required', 'array'],
            'questions.*' => ['required', 'string', 'min:10'],
            'quiz_id' => ['required', 'integer', 'exists:quizzes,id'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $quiz = Quiz::where('id', $this->quiz_id)->first();
            if($quiz){
                if(count($this->questions) > $quiz->questions_count){
                    $validator->errors()->add('quiz', 'O número de perguntas excede o limite permitido para este quiz');
                }
                if($quiz->questions->count() - $quiz->questions_count == 0){
                    $validator->errors()->add('quiz', 'O quiz já alcançou o máximo de perguntas cadastradas');
                }
            } else {
                $validator->errors()->add('quiz', 'O quiz não foi encontrado');
            }
        });
    }
}
