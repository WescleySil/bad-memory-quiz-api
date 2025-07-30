<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\IndexAnswerRequest;
use App\Http\Requests\Answer\StoreAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Services\Answer\IndexAnswerService;
use App\Services\Answer\StoreAnswerService;

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

        return response()->json(AnswerResource::collection($answers), 201);
    }
}
