<?php

namespace App\Http\Controllers;

use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Exceptions\VerifyEmailTokenInvalidException;
use App\Http\Requests\AuthForgotPasswordRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthVerifyEmailRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param AuthLoginRequest $request
     * @return UserResource
     * @throws LoginInvalidException
     */
    public function login(AuthLoginRequest $request)
    {
        $data = $request->validated();
        $token = $this->authService->login($data);

        return (new UserResource(auth()->user()))->additional($token);
    }

    /**
     * @param AuthRegisterRequest $request
     * @return UserResource
     * @throws UserHasBeenTakenException
     */
    public function register(AuthRegisterRequest $request)
    {
        $data = $request->validated();
        $user = $this->authService->register($data);

        return new UserResource($user);
    }

    /**
     * @param AuthVerifyEmailRequest $request
     * @return UserResource
     * @throws VerifyEmailTokenInvalidException
     */
    public function verifyEmail(AuthVerifyEmailRequest $request)
    {
        $data = $request->validated();

        $user = $this->authService->verifyEmail($data['token']);

        return new UserResource($user);
    }

    /**
     * @param AuthForgotPasswordRequest $request
     * @return void
     */
    public function forgotPassword(AuthForgotPasswordRequest $request)
    {
        $data = $request->validated();

        $this->authService->forgotPassword($data['email']);
    }
}
