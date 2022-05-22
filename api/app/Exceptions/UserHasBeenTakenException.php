<?php

namespace App\Exceptions;

use Exception;

class UserHasBeenTakenException extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => 'User has been taken'
        ], 401);
    }
}
