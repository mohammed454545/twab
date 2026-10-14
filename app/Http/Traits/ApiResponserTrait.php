<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponserTrait
{
    protected function successResponse(
        mixed $data = null,
        int $httpResponseCode = 200,
        ?string $message = null
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'errors' => null,
        ], $httpResponseCode);
    }

    protected function errorResponse(
        string $message,
        ?array $errors = null,
        int $httpResponseCode = 400
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
            'errors' => $errors,
        ], $httpResponseCode);
    }
}