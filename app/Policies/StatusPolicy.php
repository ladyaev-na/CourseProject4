<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StatusPolicy
{
    public function store(User $user): bool
    {
        return $user->role->code === 'admin';
    }
    public function update(User $user, Status $Status): bool
    {
        return $user->role->code === 'admin';
    }
    public function delete(User $user, Status $Status): bool
    {
        return $user->role->code === 'admin';
    }
}
