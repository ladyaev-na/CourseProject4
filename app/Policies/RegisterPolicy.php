<?php

namespace App\Policies;

use App\Models\User;

class RegisterPolicy
{
    public function register(User $user): bool
    {
        return $user->role->code === 'admin';
    }
}
