<?php

namespace App\Policies;

use App\Models\Fine;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FinePolicy
{
    public function store(User $user): bool
    {
        return $user->role->code === 'admin';
    }
    public function update(User $user, Fine $Fine): bool
    {
        return $user->role->code === 'admin';
    }
    public function delete(User $user, Fine $Fine): bool
    {
        return $user->role->code === 'admin';
    }
}
