<?php

namespace App\Services\Question;

use App\Models\Question;

class StoreQuestionService
{
    private Question $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function run($data)
    {
        foreach($data['questions'] as $question) {
            $newData['question'] = $question;
            $newData['quiz_id'] = $data['quiz_id'];
            $questions[] = $this->question->create($newData);
        }

        return $questions;
    }
}
