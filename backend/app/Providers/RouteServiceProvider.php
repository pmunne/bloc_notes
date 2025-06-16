<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Rutas para la API
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        // Rutas web
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
