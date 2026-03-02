<?php

namespace App\Http\Controllers\Dossier;

use App\Domain\Dossiers\Actions\ArchiveDossierAction;
use App\Domain\Dossiers\Actions\CreateDossierAction;
use App\Domain\Dossiers\Actions\UpdateDossierAction;
use App\Domain\Dossiers\DTO\DossierData;
use App\Domain\Dossiers\Models\Dossier;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dossiers\StoreDossierRequest;
use App\Http\Requests\Dossiers\UpdateDossierRequest;
use Inertia\Inertia;
use App\Domain\Annexes\Models\Annexe;

class DossierController extends Controller
{
    public function index()
    {
        return Inertia::render('Dossiers/Index', [
            'dossiers' => Dossier::query()
                ->with('user')
                ->latest()
                ->paginate(15),
        ]);
    }

    public function show(Dossier $dossier)
    {
        return Inertia::render('Dossiers/Show', [
            'dossier' => $dossier->load(['user']),
        ]);
    }

    public function create()
    {
        $annexes = Annexe::all();
        return Inertia::render('Dossiers/Create', [
            'annexes' => $annexes,
        ]);
    }

    public function store(StoreDossierRequest $request, CreateDossierAction $action)
    {
        $validated = $request->validated();

        // Map id_utilisateur to user_id for the DTO
        $validated['user_id'] = $validated['id_utilisateur'];
        unset($validated['id_utilisateur']);

        $data = new DossierData(...$validated);
        $action->handle($data);

        return redirect()->route('dossiers.index')->with('success', 'Dossier créé');
    }

    public function update(UpdateDossierRequest $request, Dossier $dossier, UpdateDossierAction $action)
    {
        $action->handle($dossier, $request->validated());

        return redirect()->back()->with('success', 'Dossier mis à jour');
    }

    public function destroy(Dossier $dossier, ArchiveDossierAction $action)
    {
        $action->handle($dossier);

        return redirect()->route('dossiers.index')->with('success', 'Dossier archivé');
    }
}
