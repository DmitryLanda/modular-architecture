<?php

namespace App\User\Domain;

interface UserRepositoryInterface
{
    public function getUserById(string $id): User;

    public function createUser(string $id, string $firstName, string $lastName): User;
}
