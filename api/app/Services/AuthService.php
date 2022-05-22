<?php

namespace App\Services;

use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
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

        return User::create($data);
    }
}
