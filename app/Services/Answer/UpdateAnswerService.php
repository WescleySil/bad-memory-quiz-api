<?php

namespace App\Services\Answer;

use App\Helpers\IaHelper;
use App\Models\Answer;

class UpdateAnswerService
{
    public function run(array $data, Answer $answer)
    {
        $generateNewDistractors = $data['generate_new_distractors'] ?? false;
        $answer->update($data);
        if ($generateNewDistractors) {
            $answers = Answer::query()
                ->where('question_id', $answer->question_id)
                ->where('is_correct', false)
                ->get('answer');
            $distractors =  IaHelper::regenerateDistractors($answer->question->question ,$data['answer'], $answers);
            dd($distractors);
            $wrongAnswers = $this->sanitizeData($distractors);
            foreach ($answers as $key => $answer) {
                dd($answer, $wrongAnswers[$key]);
                return $answer->update(['answer' => $wrongAnswers[$key]]);
            }
        }

        return Answer::query()->where('question_id', $answer->question_id)->get();
    }

    private function sanitizeData($data)
    {
        $answers = $data['choices'][0]['message']['content'] ?? '';
        $answers = str_replace(['{', "}\n"], '', $answers);
        return explode(', ', $answers);
    }
}
