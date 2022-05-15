<?php

namespace App\Services;

use App\Exceptions\LoginInvalidException;

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
}
