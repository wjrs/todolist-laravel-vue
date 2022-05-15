<?php

namespace App\Exceptions;

use Exception;

class LoginInvalidException extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'error' => self::class,
            'message' => 'Email or password does not match.'
        ], 401);
    }
}
