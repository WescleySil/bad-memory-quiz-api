<?php

namespace App\Services\Question;

class UpdateQuestionService
{
    public function run($data, $question)
    {
        $question->update($data);

        return $question;
    }
}
