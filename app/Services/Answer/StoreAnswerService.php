<?php

namespace App\Services\Answer;

use App\Helpers\IaHelper;
use App\Models\Answer;
use App\Models\Question;

class StoreAnswerService
{
    private Answer $answer;

    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }
    public function run(array $data)
    {
        $data['is_correct'] = true;
        $this->answer->create($data);
        $question = Question::where('id', $data['question_id'])->first();
        $distractors =  IaHelper::generateDistractors($question ,$data['answer']);
        $answers = $this->sanitizeData($distractors);

        foreach ($answers as $answer) {
            $wrongAnswer = new Answer();
            $wrongAnswer->create([
                'question_id' => $data['question_id'],
                'answer' => $answer,
                'is_correct' => false
            ]);
        }

        return $this->answer->where('question_id', $data['question_id'])->get();
    }

    private function sanitizeData($data)
    {
        $answers = $data['choices'][0]['message']['content'] ?? '';
        $answers = str_replace(['{', "}\n"], '', $answers);
        return explode(', ', $answers);
    }
}
