<?php

namespace App\User\Application\Response;

use App\User\Domain\User;

class UserCreatedDto
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public static function fromUser(User $user): self
    {
        return new self($user->getId());
    }
}
