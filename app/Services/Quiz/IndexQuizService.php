<?php

namespace App\Services\Quiz;

use App\Models\Quiz;

class IndexQuizService
{
    public function run()
    {
        $quizzes = Quiz::all();
        return $quizzes;
    }
}
