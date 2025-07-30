<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\IndexAnswerRequest;
use App\Http\Requests\Answer\StoreAnswerRequest;
use App\Http\Requests\Answer\UpdateAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Services\Answer\IndexAnswerService;
use App\Services\Answer\StoreAnswerService;
use App\Services\Answer\UpdateAnswerService;

class AnswerController extends Controller
{
    public function index(
        IndexAnswerRequest $request,
        IndexAnswerService $service
    )
    {
        $data = $request->validated();
        $answers = $service->run($data);

        return response()->json(AnswerResource::collection($answers), 200);
    }

    public function store(
        StoreAnswerRequest $request,
        StoreAnswerService $service
    )
    {
        $data = $request->validated();
        $answers = $service->run($data);

        dd($answers);

        return response()->json(AnswerResource::collection($answers), 201);
    }

    public function update(
        UpdateAnswerRequest $request,
        UpdateAnswerService $service,
        Answer $answer
    )
    {
        $data = $request->validated();
        $answers = $service->run($data, $answer);

        return response()->json(AnswerResource::collection($answers), 200);
    }
}
