<?php

namespace App\Domain\Annexes\Models;

use App\Domain\Districts\Models\District;
use Illuminate\Database\Eloquent\Model;

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
