<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class MeController extends Controller
{
    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return UserResource
     */
    public function index()
    {
        return new UserResource(auth()->user());
    }


    public function update(MeUpdateRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->update(auth()->user(), $data);

        return new UserResource($user);
    }
}
