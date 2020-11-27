<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeAccountPasswordRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController
{
    public function changePassword(ChangeAccountPasswordRequest $request): JsonResponse
    {
        $user = Auth::user();

        $user->password = Hash::make($request->get('password'));

        $user->save();

        return new JsonResponse($user, JsonResponse::HTTP_OK);
    }

    public function update(UpdateAccountRequest $request): JsonResponse
    {
        $user = Auth::user();

        $user->fill($request->validated());

        $user->save();

        return new JsonResponse($user, JsonResponse::HTTP_OK);
    }

    public function get(): JsonResponse
    {
        return new JsonResponse(Auth::user(), JsonResponse::HTTP_OK);
    }
}
