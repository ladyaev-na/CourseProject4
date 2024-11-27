<?php

namespace App\Policies;

use App\Models\Access;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccessesConfirmPolicy
{
    use HandlesAuthorization;

    public function confirm(User $user, Access $access): bool
    {
        return $user->role->code === 'admin';
    }
}
