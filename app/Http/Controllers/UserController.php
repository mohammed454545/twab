<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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


    public function index(IndexUserRequest $request)
    {
        $filters = $request->validated();

        $users = $this->userService->getAllUsers($filters);

        $message = $users->isEmpty()
            ? __('users.messages.empty')
            : __('users.success.listed');

        return $this->successResponse(
            (new UserCollection($users))->toArray($request),
            200,
            $message
        );
    }

    public function list(Request $request)
    {

        $users = $this->userService->getAllUsersList();

        $message = $users->isEmpty()
            ? __('users.messages.empty')
            : __('users.success.listed');

        return $this->successResponse(
            $users,
            200,
            $message
        );
    }

    public function show(Request $request, int $id)
    {
        $user = $this->userService->getUserById($id);

        return $this->successResponse(
            (new UserResource($user))->resolve($request),
            200,
            __('users.success.retrieved')
        );
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser(
            $request->validated()
        );

        return $this->successResponse(
            (new UserResource($user))->resolve($request),
            201,
            __('users.success.created')
        );
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $user = $this->userService->updateUser(
            $id,
            $request->validated()
        );

        return $this->successResponse(
            (new UserResource($user))->resolve($request),
            200,
            __('users.success.updated')
        );
    }

    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);

        return response()->noContent();
    }
}
