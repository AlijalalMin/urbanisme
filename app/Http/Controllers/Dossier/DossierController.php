<?php

namespace App\Http\Controllers\Dossier;

use App\Domain\Dossiers\DTO\DossierData;
use App\Domain\Dossiers\Models\Dossier;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dossiers\StoreDossierRequest;
use App\Http\Requests\Dossiers\UpdateDossierRequest;
use Inertia\Inertia;
use App\Domain\Annexes\Models\Annexe;
use App\Domain\Dossiers\Services\DossierService;

class DossierController extends Controller
{
    public function __construct(
        private DossierService $dossierService
    ) {}

    public function index()
    {
        return Inertia::render('Dossiers/Index', [
            'dossiers' => $this->dossierService->getPaginatedList(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Dossiers/Create', [
            'annexes' => Annexe::all(),
        ]);
    }

    public function show(Dossier $dossier)
    {
        return Inertia::render('Dossiers/Show', [
            'dossier' => $this->dossierService->showDossier($dossier->id),
        ]);
    }

    public function store(StoreDossierRequest $request)
    {
        // 1. Transform Request to DTO
        $dto = DossierData::fromRequest($request);

        // 2. Delegate to Service
        $this->dossierService->createDossier($dto);

        return redirect()->route('dossiers.index')->with('success', 'Dossier créé');
    }

    public function update(UpdateDossierRequest $request, Dossier $dossier)
    {
        $this->dossierService->updateDossier($dossier, $request->validated());

        return redirect()->back()->with('success', 'Dossier mis à jour');
    }

    public function destroy(Dossier $dossier)
    {
        $this->dossierService->archiveDossier($dossier);

        return redirect()->route('dossiers.index')->with('success', 'Dossier archivé');
    }
}
