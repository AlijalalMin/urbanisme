<?php

namespace App\Domain\Districts\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Annexes\Models\Annexe;

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