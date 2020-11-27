<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthController
{
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            throw new BadRequestHttpException('Wrong login credentials!');
        }

        $user = Auth::user();

        $user->tokens()->delete();

        $token = $user->createToken('auth');

        return new JsonResponse([
            'user' => $user,
            'token' => $token->accessToken
        ], JsonResponse::HTTP_OK);
    }
}
