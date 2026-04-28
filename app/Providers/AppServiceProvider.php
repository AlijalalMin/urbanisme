<?php

namespace App\Providers;

use App\Domain\Dossiers\Repositories\DossierRepository;
use App\Domain\Dossiers\Repositories\DossierRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DossierRepositoryInterface::class, DossierRepository::class);
        $this->app->bind(
            \App\Domain\Infractions\Repositories\InfractionRepositoryInterface::class,
            \App\Domain\Infractions\Repositories\InfractionRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
