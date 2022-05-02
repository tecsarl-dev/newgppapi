<?php

namespace App\Gpp\Localities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Locality extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'is_active',
        'district_id',
    ];

    public function depots(): HasMany
    {
        return $this->hasMany('App\Gpp\Depots\Depot','id');
    }

    public function rates(): HasMany
    {
        return $this->hasMany('App\Gpp\Rates\Rate','id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Districts\District');
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Communes\Commune');
    }
}
