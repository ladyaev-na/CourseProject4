<?php

namespace App\Policies;

use App\Models\Access;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AccessPolicy
{
    public function store(User $user): bool
    {
        return $user->role->code === 'сourier';
    }
}
