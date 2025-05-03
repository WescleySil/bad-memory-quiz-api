<?php

namespace App\Services\Question;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class IndexQuestionService
{
    public function run($data)
    {
        $quiz = $data['filters']['quiz_id'] ?? null;

        $questions  = Question::with('quiz')
            ->when($quiz, fn($query) => $query->where('quiz_id', $quiz))
            ->get();

        return $questions;
    }
}
