<?php

namespace App\Http\Controllers;

use App\Enums\FishnetEnum;
use App\Enums\FishnetStateEnum;
use App\Enums\NotificationsEnum;
use App\Http\Requests\FishnetRequest;
use App\Models\Fishnet;
use App\Models\Notification;
use App\Notifications\StatusChangedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FishnetsController
{
    public function addFishnet(FishnetRequest $request): JsonResponse
    {
        $fishnet = new Fishnet();

        $fishnet->fill($request->validated());

        $fishnet->save();

        return new JsonResponse($fishnet, JsonResponse::HTTP_CREATED);
    }

    public function updateFishnet(FishnetRequest $request, Fishnet $fishnet): JsonResponse {
        $fishnet->fill($request->validated());

        $fishnet->save();

        return new JsonResponse($fishnet, JsonResponse::HTTP_OK);
    }

    public function getFishnet(Fishnet $fishnet): JsonResponse
    {
        return new JsonResponse($fishnet, JsonResponse::HTTP_OK);
    }

    public function getFishnets(): JsonResponse
    {
        $fishnets = Fishnet::with(['customer', 'seller'])->get();

        return new JsonResponse($fishnets, JsonResponse::HTTP_OK);
    }

    public function deleteFishnet(Fishnet $fishnet): JsonResponse
    {
        $fishnet->delete();

        return new JsonResponse($fishnet, JsonResponse::HTTP_OK);
    }

    public function changeStatus(Fishnet $fishnet, Request $request): JsonResponse
    {
        $user = Auth::user();

        $state = $request->get('state');

        if (!in_array($state, FishnetEnum::ALL)) {
            return new JsonResponse('given state does not exist.', JsonResponse::HTTP_NOT_FOUND);
        }

        $fishnet->state = $state;

        $fishnet->save();

        Notification::send($user, new StatusChangedNotification($user, $fishnet), NotificationsEnum::FISHNET_STATUS_CHANGED);

        return new JsonResponse($fishnet, JsonResponse::HTTP_OK);
    }

    public function markAsLost(Fishnet $fishnet): JsonResponse
    {
        $fishnet->state = FishnetEnum::LOST;

        $fishnet->save();

        return new JsonResponse($fishnet, JsonResponse::HTTP_OK);
    }

    public function viewMy(): JsonResponse
    {
        $userId = Auth::id();

        $fishnets = Fishnet::where('customer_id', $userId)->orWhere('seller_id', $userId)->get();

        return new JsonResponse($fishnets, JsonResponse::HTTP_OK);
    }
}