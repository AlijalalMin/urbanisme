<?php

namespace App\Domain\Annexes\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Districts\Models\District;

class Annexe extends Model
{
    protected $table = 'annexes';
    protected $fillable = [
        'nom',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}