<?php

namespace App\User\Application;

use App\User\Application\Request\CreateUserDto;
use App\User\Application\Response\UserCreatedDto;
use App\User\Domain\User;
use App\User\Domain\UserRepositoryInterface;
use App\User\Domain\UserStorageInterface;
use Faker\Factory;
use Faker\Generator;

class UserCreator
{
    private UserRepositoryInterface $repository;
    private Generator $faker;
    private UserStorageInterface $storage;

    /**
     * @todo:
     */
    public function __construct(UserRepositoryInterface $repository, UserStorageInterface $storage)
    {
        $this->repository = $repository;
        $this->faker = Factory::create();
        $this->storage = $storage;
    }

    /**
     * @todo - Return Domain/User seems bad. Need to map it into separate dto?
     */
    public function createUser(CreateUserDto $request): UserCreatedDto
    {
        //what to do if there will be 10 args?
        $user = $this->repository->createUser(
            $this->generateId(),
            $request->getFirstName(),
            $request->getLastName()
        );
        $user->setAvatar($this->generateDefaultAvatar($request));
        $this->storage->save($user);

        return UserCreatedDto::fromUser($user);
    }

    /**
     * @todo - Standalone service? It will increase number of dependencies..
     * @todo - Can we use here Domain/User instead of request as arg?
     * @todo = Avatar generation logic - part of Application or Domain?
     */
    private function generateDefaultAvatar(CreateUserDto $request): string
    {
        $initials = strtoupper(ucfirst($request->getFirstName()) . ucfirst($request->getLastName()));

        return $this->faker->imageUrl(word: $initials);
    }

    /**
     * @todo - Standalone service?
     * @todo - ID generation logic - part of Application or Domain?
     */
    protected function generateId()
    {
        return $this->faker->uuid;
    }
}
