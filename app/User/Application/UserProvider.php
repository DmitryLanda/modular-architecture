<?php

namespace App\User\Application;

use App\User\Application\Response\UserDto;
use App\User\Domain\UserRepositoryInterface;

class UserProvider
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getUserById(string $id): UserDto
    {
        $user = $this->repository->getUserById($id);

        return UserDto::fromUser($user);
    }
}
