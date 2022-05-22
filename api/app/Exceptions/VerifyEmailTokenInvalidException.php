<?php

namespace App\Exceptions;

use Exception;

class VerifyEmailTokenInvalidException extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => 'E-mail token is invalid'
        ], 400);
    }
}
