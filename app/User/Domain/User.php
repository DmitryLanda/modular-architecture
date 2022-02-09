<?php

namespace App\User\Domain;

class User
{
    private string $id;
    private string $firstName;
    private string $lastName;
    private string $avatar;

    public function __construct(string $firstName, string $lastName, string $avatar, ?string $id)
    {
        $this->id = $id ?? 'xxx';
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->avatar = $avatar;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }
}
