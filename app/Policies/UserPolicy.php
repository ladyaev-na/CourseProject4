<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function destroy(User $user, User $model)
    {
        return $user->role->code === 'admin';
    }
}
