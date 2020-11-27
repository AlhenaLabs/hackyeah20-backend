<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class NotificationsController
{
    public function getForUser(User $user): JsonResponse
    {
        $notifications = $user->notifications()->get();

        return new JsonResponse($notifications, JsonResponse::HTTP_OK);
    }
}
