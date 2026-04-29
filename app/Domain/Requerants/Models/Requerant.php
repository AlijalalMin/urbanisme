<?php

namespace App\Domain\Requerants\Models;

use App\Domain\Dossiers\Models\Dossier;
use App\Enums\RequerantTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Requerant extends Model
{
    use SoftDeletes;

    protected $table = 'requerants';

    protected $fillable = [
        'nom',
        'cin',
        'contact',
        'adresse',
        'type_requerant',
        'ice',
    ];

    protected $casts = [
        'type_requerant' => RequerantTypeEnum::class,
    ];

    /**
     * The dossiers that belong to the requerant.
     */
    public function dossiers(): BelongsToMany
    {
        return $this->belongsToMany(Dossier::class, 'dossier_requerant')
            ->withPivot(['role', 'commentaire'])
            ->withTimestamps();
    }
}
