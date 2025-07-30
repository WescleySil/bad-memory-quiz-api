<?php

namespace App\Services\Answer;

use App\Models\Answer;

class IndexAnswerService
{
    public function run($data)
    {
        return Answer::all();
    }
}
