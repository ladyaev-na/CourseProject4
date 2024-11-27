<?php

namespace App\Policies;

use App\Models\Bonus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BonusPolicy
{
    public function store(User $user): bool
    {
        return $user->role->code === 'admin';
    }
    public function update(User $user, Bonus $bonus): bool
    {
        return $user->role->code === 'admin';
    }
    public function delete(User $user, Bonus $bonus): bool
    {
        return $user->role->code === 'admin';
    }
}
