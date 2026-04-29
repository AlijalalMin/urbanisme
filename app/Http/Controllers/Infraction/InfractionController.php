<?php

namespace App\Http\Controllers\Infraction;

use App\Domain\Dossiers\Models\Dossier;
use App\Domain\Infractions\DTO\InfractionData;
use App\Domain\Infractions\Models\Infraction;
use App\Domain\Infractions\Services\InfractionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Infractions\StoreInfractionRequest;
use App\Http\Requests\Infractions\UpdateInfractionRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InfractionController extends Controller
{
    public function __construct(
        private InfractionService $infractionService
    ) {}

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'dossier_id']);

        return Inertia::render('Infractions/Index', [
            'infractions' => $this->infractionService->getPaginatedList($filters),
            'filters' => $filters,
        ]);
    }

    public function create()
    {
        return Inertia::render('Infractions/Create', [
            'dossiers' => Dossier::select('id', 'numero_dossier')->get(),
        ]);
    }

    public function store(StoreInfractionRequest $request)
    {
        $dto = InfractionData::fromRequest($request);
        $this->infractionService->createInfraction($dto);

        return redirect()->route('infractions.index')->with('success', 'Infraction créée');
    }

    public function show(Infraction $infraction)
    {
        return Inertia::render('Infractions/Show', [
            'infraction' => $this->infractionService->showInfraction($infraction->id),
        ]);
    }

    public function edit(Infraction $infraction)
    {
        return Inertia::render('Infractions/Edit', [
            'infraction' => $this->infractionService->showInfraction($infraction->id),
            'dossiers' => Dossier::select('id', 'numero_dossier')->get(),
        ]);
    }

    public function update(UpdateInfractionRequest $request, Infraction $infraction)
    {
        $this->infractionService->updateInfraction($infraction, $request->validated());

        return redirect()->route('infractions.index')->with('success', 'Infraction mise à jour');
    }

    public function destroy(Infraction $infraction)
    {
        $this->infractionService->deleteInfraction($infraction);

        return redirect()->route('infractions.index')->with('success', 'Infraction supprimée');
    }
}
