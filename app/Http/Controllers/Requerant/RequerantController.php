<?php

namespace App\Http\Controllers\Requerant;

use App\Domain\Requerants\Services\RequerantService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequerantController extends Controller
{
    public function __construct(
        protected RequerantService $requerantService
    ) {}

    public function store(Request $request, $dossierId)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'cin' => 'nullable|string|max:20',
            'contact' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'type_requerant' => 'nullable|string',
            'ice' => 'nullable|string|max:255',
            'role' => 'nullable|string',
            'commentaire' => 'nullable|string',
        ]);

        $this->requerantService->createRequerantForDossier($validated, (int) $dossierId);

        return redirect()->back()->with('success', 'Requérant ajouté avec succès');
    }
}
