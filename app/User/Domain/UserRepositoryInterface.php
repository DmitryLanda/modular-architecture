<?php

namespace App\User\Domain;

interface UserRepositoryInterface
{
    public function getUserById(string $id): User;
}
