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
        return new User(
            $this->faker->firstName,
            $this->faker->lastName,
            $this->faker->imageUrl,
            $id
        );
    }
}
