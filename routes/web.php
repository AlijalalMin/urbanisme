<?php

use App\Http\Controllers\Dossier\DossierController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('dossiers')->group(function () {
        Route::get('/', [DossierController::class, 'index'])->name('dossiers.index');
        Route::get('/create', [DossierController::class, 'create'])->name('dossiers.create');
        Route::get('/{dossier}/edit', [DossierController::class, 'edit'])->name('dossiers.edit');
        Route::get('/{dossier}', [DossierController::class, 'show'])->name('dossiers.show');
        Route::post('/store', [DossierController::class, 'store'])->name('dossiers.store');
        Route::put('/{dossier}', [DossierController::class, 'update'])->name('dossiers.update');
        Route::delete('/{dossier}', [DossierController::class, 'destroy'])->name('dossiers.destroy');
    });

    Route::prefix('infractions')->group(function () {
        Route::get('/', [\App\Http\Controllers\Infraction\InfractionController::class, 'index'])->name('infractions.index');
        Route::get('/create', [\App\Http\Controllers\Infraction\InfractionController::class, 'create'])->name('infractions.create');
        Route::post('/store', [\App\Http\Controllers\Infraction\InfractionController::class, 'store'])->name('infractions.store');
        Route::get('/{infraction}/edit', [\App\Http\Controllers\Infraction\InfractionController::class, 'edit'])->name('infractions.edit');
        Route::put('/{infraction}', [\App\Http\Controllers\Infraction\InfractionController::class, 'update'])->name('infractions.update');
        Route::get('/{infraction}', [\App\Http\Controllers\Infraction\InfractionController::class, 'show'])->name('infractions.show');
        Route::delete('/{infraction}', [\App\Http\Controllers\Infraction\InfractionController::class, 'destroy'])->name('infractions.destroy');
    });
});

require __DIR__.'/settings.php';
