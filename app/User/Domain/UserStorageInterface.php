<?php

namespace App\User\Domain;

interface UserStorageInterface
{
    public function save(User $user): bool;
}
