<?php

namespace App\Services\Quiz;

class UpdateQuizService
{
    public function run($data, $quiz)
    {
        $quiz->update($data);

        return $quiz;
    }
}
