<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quiz\IndexQuizRequest;
use App\Http\Requests\Quiz\StoreQuizRequest;
use App\Http\Requests\Quiz\UpdateQuizRequest;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use App\Services\Quiz\IndexQuizService;
use App\Services\Quiz\StoreQuizService;
use App\Services\Quiz\UpdateQuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(
        IndexQuizRequest $request,
        IndexQuizService $service
    )
    {
        $data = $request->validated();
        $quizzes = $service->run($data);

        return response()->json(QuizResource::collection($quizzes), 200);
    }

    public function store(
        StoreQuizRequest $request,
        StoreQuizService $service
    )
    {
        $data = $request->validated();
        $quiz = $service->run($data);

        return response()->json(new QuizResource($quiz), 201);
    }

    public function update(
        UpdateQuizRequest $request,
        UpdateQuizService $service,
        Quiz $quiz
    )
    {
        $data = $request->validated();
        $quiz = $service->run($data, $quiz);

        return response()->json(new QuizResource($quiz), 200);
    }

    public function destroy(
        Quiz $quiz,
    )
    {
        return response()->json($quiz->delete(), 204);
    }
}
