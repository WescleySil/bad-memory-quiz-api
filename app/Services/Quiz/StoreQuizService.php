<?php

namespace App\Services\Quiz;

use App\Models\Quiz;

class StoreQuizService
{

    private Quiz $quiz;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function run($data)
    {
        $data['user_id'] = auth()->id();

        $quiz = $this->quiz->create($data);

        return $quiz;
    }
}
