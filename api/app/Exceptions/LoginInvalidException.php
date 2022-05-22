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
            'error' => class_basename($this),
            'message' => 'Email or password does not match.'
        ], 401);
    }
}
