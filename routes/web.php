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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard', [
            'stats' => [
                'total_dossiers' => \App\Domain\Dossiers\Models\Dossier::count(),
                'total_infractions' => \App\Domain\Infractions\Models\Infraction::count(),
                'recent_activities' => [
                    // Combining recent dossiers and infractions for a unified timeline
                    ...(\App\Domain\Dossiers\Models\Dossier::latest()->take(5)->get()->map(fn($d) => [
                        'type' => 'dossier',
                        'title' => "Nouveau dossier: {$d->numero_dossier}",
                        'description' => $d->objet,
                        'time' => $d->created_at->diffForHumans(),
                        'id' => $d->id
                    ])),
                    ...(\App\Domain\Infractions\Models\Infraction::latest()->take(5)->get()->map(fn($i) => [
                        'type' => 'infraction',
                        'title' => "Nouvelle infraction: {$i->numero_infraction}",
                        'description' => $i->statut_infraction,
                        'time' => $i->created_at->diffForHumans(),
                        'id' => $i->id
                    ])),
                ]
            ]
        ]);
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
