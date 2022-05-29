<?php

namespace App\Services;

use App\Exceptions\UserHasBeenTakenException;
use App\Models\User;

class UserService
{
    public function update(User $user, array $data)
    {
        /*if (!empty($data['email']) && User::where('email', $data['email'])->exists()) {
            throw new UserHasBeenTakenException();
        }*/

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->fill($data);
        $user->save();

        return $user->fresh();
    }
}
