<?php

namespace App\User;

use App\User\Domain\UserRepositoryInterface;
use App\User\Infrastructure\UserFakeRepository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class PackageProvider extends RouteServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserFakeRepository::class);
    }

    public function boot(): void
    {

    }
}
