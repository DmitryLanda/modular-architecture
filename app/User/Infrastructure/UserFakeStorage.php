<?php

namespace App\User\Infrastructure;

use App\User\Domain\User;
use App\User\Domain\UserStorageInterface;

class UserFakeStorage implements UserStorageInterface
{
    public function save(User $user): bool
    {
        return true;
    }
}
