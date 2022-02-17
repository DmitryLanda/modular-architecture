<?php

namespace App\User\Entrypoint\Internal;

use App\User\Application\Response\UserDto;
use App\User\Application\UserProvider;

class UserModule
{
    private UserProvider $provider;

    public function __construct(UserProvider $provider)
    {
        $this->provider = $provider;
    }

    public function getUserById(string $id): UserDto
    {
        return $this->provider->getUserById($id);
    }
}
