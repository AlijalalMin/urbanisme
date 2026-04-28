<?php

namespace App\Domain\Districts\Models;

use App\Domain\Annexes\Models\Annexe;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'nom',
        'code_district',
        'gps_zone',
    ];

    public function annexes()
    {
        return $this->hasMany(Annexe::class);
    }
}
