<?php

namespace App\User\Application;

use App\News\Domain\UserRepositoryInterface;
use App\User\Domain\User;

class UserProvider
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getUserById(string $id): User
    {
        return $this->repository->getUserById($id);
    }
}
