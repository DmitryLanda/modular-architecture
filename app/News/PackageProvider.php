<?php

namespace App\News;

use App\News\Domain\NewsRepositoryInterface;
use App\News\Infrastructure\NewsFakeRepository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class PackageProvider extends RouteServiceProvider
{
    public function register(): void
    {
        $this->app->bind(NewsRepositoryInterface::class, NewsFakeRepository::class);
    }

    public function boot(): void
    {
        Route::namespace($this->namespace)->group(__DIR__ . '/Config/routes.php');
    }
}
