<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(
        LoginRequest $loginRequest,
        LoginService $loginService): JsonResponse
    {
        $data = $loginRequest->validated();
        $token = $loginService->run($data);

        return response()->json($token, 200);
    }

    public function logout(): JsonResponse
    {
        $user = auth()->user();
        $user->currentAccessToken()->delete();

        return response()->json('Usuário deslogado com sucesso!', 204);
    }
}
