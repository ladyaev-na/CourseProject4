<?php

namespace App\Policies;

use App\Models\Shift;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
class ShiftPolicy
{
    use HandlesAuthorization;
    public function store(User $user, Shift $shift): bool
    {
        // Проверка прав доступа
        return $user->role->code === 'admin';
    }
}
