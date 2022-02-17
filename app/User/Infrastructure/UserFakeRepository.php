<?php

namespace App\User\Infrastructure;

use App\User\Domain\UserRepositoryInterface;
use App\User\Domain\User;
use Faker\Factory;
use Faker\Generator;

class UserFakeRepository implements UserRepositoryInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function getUserById(string $id): User
    {
        $user = new User(
            $id,
            $this->faker->firstName,
            $this->faker->lastName
        );
        $user->setAvatar($this->faker->imageUrl);

        return $user;
    }

    public function createUser(string $id, string $firstName, string $lastName): User
    {
        return new User(
            $id,
            $firstName,
            $lastName
        );
    }
}
