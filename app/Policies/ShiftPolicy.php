<?php

namespace App\Policies;

use App\Models\Shift;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
class ShiftPolicy
{
    public function store(User $user, Shift $shift): bool
    {
        return $user->role->code === 'сourier';
    }
}
