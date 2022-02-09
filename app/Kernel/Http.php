<?php

namespace App\Kernel;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;

class Http extends HttpKernel
{
    protected $middleware = [
        CheckForMaintenanceMode::class,
    ];
}
