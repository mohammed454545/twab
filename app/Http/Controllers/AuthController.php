<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponserTrait;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponserTrait;
    public function __construct(protected AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());

        return $this->successResponse([
            'user' => new UserResource($result['user']),
            'access_token' => $result['access_token'],
            'token_type' => $result['token_type'],
            'expires_in' => $result['expires_in'],
        ], 201, __('auth.success.registered'));
    }

    public function login(LoginRequest $request): JsonResponse
{
    $result = $this->authService->login(
        $request->validated()
    );

    if (!$result['success']) {

        $showDetails = config('auth.detailed_login_errors', false);

        $messageKey = $showDetails
            ? match ($result['error']) {
                'email_not_found' => 'auth.errors.email_not_found',
                'incorrect_password' => 'auth.errors.incorrect_password',
                default => 'auth.errors.invalid_credentials',
            }
            : 'auth.errors.invalid_credentials';

        return $this->errorResponse(
            __($messageKey),
            null,
            401
        );
    }

    $data = $result['data'];

    return $this->successResponse([
        'user' => new UserResource($data['user']),
        'access_token' => $data['access_token'],
        'token_type' => $data['token_type'],
        'expires_in' => $data['expires_in'],
    ], 200, __('auth.success.logged_in'));
}

    public function me(): JsonResponse
    {
        $user = $this->authService->me();
        return $this->successResponse(
            new UserResource($user),
            200,
            __('auth.success.user_retrieved')
        );
    }

    public function refresh(): JsonResponse
    {
        $result = $this->authService->refresh();
        return $this->successResponse([
            'access_token' => $result['access_token'],
            'token_type' => $result['token_type'],
            'expires_in' => $result['expires_in'],
        ], 200, __('auth.success.refreshed'));
    }

    public function logout() : JsonResponse {
         $this->authService->logout();

        return $this->successResponse(
            null,
            200,
            __('auth.success.logged_out')
        );
    }
}
