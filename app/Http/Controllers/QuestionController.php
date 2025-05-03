<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\IndexQuestionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Services\Question\IndexQuestionService;
use App\Services\Question\StoreQuestionService;
use App\Services\Question\UpdateQuestionService;

class QuestionController extends Controller
{
    public function index(
        IndexQuestionRequest $request,
        IndexQuestionService $service
    )
    {
        $data = $request->validated();
        $questions = $service->run($data);

        return QuestionResource::collection($questions);
    }

    public function store(
        StoreQuestionRequest $request,
        StoreQuestionService $service,
    )
    {
        $data = $request->validated();
        $questions = $service->run($data);

        return response()->json(QuestionResource::collection($questions), 201);
    }

    public function update(
        UpdateQuestionRequest $request,
        UpdateQuestionService $service,
        Question $question
    )
    {
        $data = $request->validated();
        $question = $service->run($data, $question);

        return response()->json(new QuestionResource($question), 200);
    }

    public function destroy(
        Question $question,
    )
    {
        return response()->json($question->delete(), 204);
    }
}
