<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\AllowedClassesComposer;


class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(VimeoService::class, function ($app) {
            return new VimeoService();
        });
    }

    public function boot(): void
    {
        View::composer('teacher.layout.app', AllowedClassesComposer::class);
    }
}
