<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponserTrait;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponserTrait;

    public function __construct(
        protected UserService $userService
    ) {}

    
    public function index(Request $request)
    {
        $users = $this->userService->getAllUsers();

        return $this->successResponse(
            (new UserCollection($users))->toArray($request),
            200,
            __('users.success.listed')
        );
    }

    public function show(Request $request, $id)
    {
        $user = $this->userService->getUserById($id);

        return $this->successResponse(
            (new UserResource($user))->resolve($request),
            200,
            __('users.success.retrieved')
        );
    }

    public function store(Request $request)
    {
        $user = $this->userService->createUser(
            $request->all()
        );

        return $this->successResponse(
            (new UserResource($user))->resolve($request),
            201,
            __('users.success.created')
        );
    }

    public function update(Request $request, $id)
    {
        $user = $this->userService->updateUser(
            $id,
            $request->all()
        );

        return $this->successResponse(
            (new UserResource($user))->resolve($request),
            200,
            __('users.success.updated')
        );
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return response()->noContent();
    }
}
