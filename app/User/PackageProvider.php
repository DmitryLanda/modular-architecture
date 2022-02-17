<?php

namespace App\User;

use App\User\Domain\UserRepositoryInterface;
use App\User\Domain\UserStorageInterface;
use App\User\Infrastructure\UserFakeRepository;
use App\User\Infrastructure\UserFakeStorage;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class PackageProvider extends RouteServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserFakeRepository::class);
        $this->app->bind(UserStorageInterface::class, UserFakeStorage::class);
    }

    public function boot(): void
    {
        Route::namespace($this->namespace)->group(__DIR__ . '/Config/routes.php');
    }
}
