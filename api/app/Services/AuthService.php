<?php

namespace App\Services;

use App\Events\ForgotPasswordEvent;
use App\Events\UserWasRegistred;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Exceptions\VerifyEmailTokenInvalidException;
use App\Models\PasswordReset;
use App\Models\User;
use Str;

class AuthService
{
    /**
     * @param array $data
     * @return array
     * @throws LoginInvalidException
     */
    public function login(array $data)
    {
        if (!$token = auth()->attempt($data)) {
            throw new LoginInvalidException();
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    /**
     * @param array $data
     * @return User
     * @throws UserHasBeenTakenException
     */
    public function register(array $data)
    {
        $user = User::where('email', $data['email'])->exists();

        if (!empty($user)) {
            throw new UserHasBeenTakenException();
        }

        $data['password'] = bcrypt($data['password']);
        $data['confirmation_token'] = Str::random(60);

        $user = User::create($data);

        if (!empty($user)) {
            event(new UserWasRegistred($user));
        }

        return $user;
    }

    /**
     * @param string $token
     * @return mixed
     * @throws VerifyEmailTokenInvalidException
     */
    public function verifyEmail(string $token)
    {
        $user = User::where('confirmation_token', $token)->first();

        if (empty($user)) {
            throw new VerifyEmailTokenInvalidException();
        }

        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }

    /**
     * @param string $email
     * @return void
     */
    public function forgotPassword(string $email)
    {
        $user = User::where('email', $email)->firstOrFail();

        $token = Str::random(60);

        PasswordReset::create([
            'email' => $user->email,
            'token' => $token
        ]);

        event(new ForgotPasswordEvent($user, $token));
    }
}
