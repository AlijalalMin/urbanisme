<?php

use App\Http\Controllers\Dossier\DossierController;
use App\Http\Controllers\Requerant\RequerantController;
use App\Http\Controllers\Auteur\AuteurController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dossiers')->group(function () {
    Route::get('/', [DossierController::class, 'index'])->name('dossiers.index');
    Route::get('/create', [DossierController::class, 'create'])->name('dossiers.create');
    Route::get('/{dossier}', [DossierController::class, 'show'])->name('dossiers.show');
    Route::post('/store', [DossierController::class, 'store'])->name('dossiers.store');
    Route::put('/{dossier}', [DossierController::class, 'update'])->name('dossiers.update');
    Route::delete('/{dossier}', [DossierController::class, 'destroy'])->name('dossiers.destroy');

    // Requérants
    Route::post('/{dossier}/requerants', [RequerantController::class, 'store'])->name('requerants.store');

    // Auteurs
    Route::post('/{dossier}/auteurs', [AuteurController::class, 'store'])->name('auteurs.store');
});

require __DIR__.'/settings.php';
