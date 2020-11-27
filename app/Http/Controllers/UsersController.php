<?php

namespace App\Http\Controllers;

use App\Enums\NotificationsEnum;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\NewPasswordNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController
{
    public function create(UserRequest $request): JsonResponse
    {
        $user = new User();

        $user->fill($request->validated());

        $password = Str::random(16);

        $user->password = Hash::make($password);

        $user->save();

        Notification::send($user, new NewPasswordNotification($user, $password), NotificationsEnum::ACCOUNT);

        return new JsonResponse($user, JsonResponse::HTTP_CREATED);
    }

    public function updateUser(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->fill($request->validated());

        $user->save();

        return new JsonResponse($user, JsonResponse::HTTP_OK);
    }

    public function getUserById(User $user): JsonResponse
    {
        return new JsonResponse($user, JsonResponse::HTTP_OK);
    }

    public function getUsers(): JsonResponse
    {
        return new JsonResponse(User::all(), JsonResponse::HTTP_OK);
    }

    public function deleteUser(User $user): JsonResponse
    {
        $user->delete();

        return new JsonResponse($user, JsonResponse::HTTP_OK);
    }

    public function resetPassword(User $user): JsonResponse
    {
        $password = Str::random(16);

        $user->password = Hash::make($password);

        $user->save();

        Notification::send($user, new NewPasswordNotification($user, $password), NotificationsEnum::ACCOUNT);

        return new JsonResponse($user, JsonResponse::HTTP_OK);
    }
}
