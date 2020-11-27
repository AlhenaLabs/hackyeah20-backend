<?php

namespace App\Http\Controllers;

use App\Models\FishnetLog;
use Illuminate\Http\JsonResponse;

class FishnetLogController
{
    public function getFishnetLog(string $id): JsonResponse
    {
        $fishnetLog = FishnetLog::where('fishnet_id', $id)->with(['fishnet', 'user'])->first();

        return new JsonResponse($fishnetLog, JsonResponse::HTTP_OK);
    }

    public function getFishnetLogs(): JsonResponse
    {
        $fishnetLogs = FishnetLog::with(['fishnet', 'user'])->get();

        return new JsonResponse($fishnetLogs, JsonResponse::HTTP_OK);
    }
}
