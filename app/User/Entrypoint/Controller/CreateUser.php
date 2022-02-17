<?php

namespace App\User\Entrypoint\Controller;

use App\User\Application\Response\UserCreatedDto;
use App\User\Application\UserCreator;
use Illuminate\Http\Request;
use App\User\Application\Request\CreateUserDto as CreateUserDto;

class CreateUser
{
    private UserCreator $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    /**
     * @todo - what the userCreator should return? Having Domain as response seems wrong..
     * @todo - where to do validation? inside tha Application?
     */
    public function __invoke(Request $request): string
    {
        $dto = new CreateUserDto(
            $request->get('first_name'),
            $request->get('last_name')
        );

        $user = $this->userCreator->createUser($dto);

        return $this->ok($user);
    }

    /**
     * @todo - where to normalize and serialize data? Seems it is responsibility of the Application layer?
     */
    private function ok(UserCreatedDto $user)
    {
        return $this->serialize($this->normalize($user));
    }

    private function normalize(UserCreatedDto $user): mixed
    {
        return ['id' => $user->getId()];
    }

    private function serialize($data): string
    {
        return json_encode($data);
    }
}
