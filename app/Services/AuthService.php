<?php

namespace App\Services;

use PHPOpenSourceSaver\JWTAuth\JWTGuard;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    private function guard(): JWTGuard
    {
        /** @var JWTGuard $guard */
        $guard = auth('api');

        return $guard;
    }

    function register(array $data): array
    {
        $user = User::create($data);
        $token = $this->guard()->login($user);
        return $this->tokenData($token, $user);
    }

    public function login(array $credentials): array
{
    $user = User::where('email', $credentials['email'])->first();

    if (!$user) {
        return [
            'success' => false,
            'error' => 'email_not_found',
        ];
    }

    if (!Hash::check($credentials['password'], $user->password)) {
        return [
            'success' => false,
            'error' => 'incorrect_password',
        ];
    }

    $token = $this->guard()->login($user);

    return [
        'success' => true,
        'data' => $this->tokenData($token, $user),
    ];
}

    function me(): User
    {
        return $this->guard()->user();
    }

    function refresh(): array
    {
        $token = $this->guard()->refresh();
        return $this->tokenData($token);
    }

    function logout(): void
    {
        $this->guard()->logout();
    }

    private function tokenData(
        string $token,
        ?User $user = null
    ): array {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user' => $user,
        ];
    }
}
