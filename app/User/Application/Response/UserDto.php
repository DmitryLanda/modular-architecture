<?php

namespace App\User\Application\Response;

use App\User\Domain\User;

class UserDto
{
    private string $id;
    private string $fullName;
    private string $avatar;

    public function __construct(string $id, string $fullName, string $avatar)
    {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->avatar = $avatar;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public static function fromUser(User $user): self
    {
        return new self(
            $user->getId(),
            implode(' ', [$user->getFirstName(), $user->getLastName()]),
            $user->getAvatar()
        );
    }
}
