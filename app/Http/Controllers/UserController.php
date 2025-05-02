<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\User\IndexUserService;
use App\Services\User\StoreUserService;
use App\Services\User\UpdateUserService;

class UserController extends Controller
{
    public function index(
        IndexUserRequest $request,
        IndexUserService $service
    )
    {
        $data = $request->validated();
        $users = $service->run($data);

        return response()->json(UserResource::collection($users), 200);
    }

    public function store(
        StoreUserRequest $request,
        StoreUserService $service
    )
    {
        $data = $request->validated();
        $user = $service->run($data);

        return response()->json(new UserResource($user), 201);
    }

    public function update(
        UpdateUserRequest $request,
        UpdateUserService $service,
        User $user
    )
    {
        $data = $request->validated();
        $user = $service->run($data, $user);

        return response()->json(new UserResource($user), 200);
    }

    public function destroy(
        User $user
    )
    {
        return response()->json($user->delete(), 204);
    }
}
