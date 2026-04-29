<?php

namespace App\Providers;

use App\Domain\Dossiers\Repositories\DossierRepository;
use App\Domain\Dossiers\Repositories\DossierRepositoryInterface;
use App\Domain\Requerants\Repositories\RequerantRepository;
use App\Domain\Requerants\Repositories\RequerantRepositoryInterface;
use App\Domain\Auteurs\Repositories\AuteurRepository;
use App\Domain\Auteurs\Repositories\AuteurRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DossierRepositoryInterface::class, DossierRepository::class);
        $this->app->bind(RequerantRepositoryInterface::class, RequerantRepository::class);
        $this->app->bind(AuteurRepositoryInterface::class, AuteurRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
