<?php

namespace App\Gpp\Communes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'is_active',
        'department_id',
    ];

    public function localities(): HasManyThrough
    {
        return $this->hasManyThrough('App\Gpp\Localities\Locality', 'App\Gpp\Districts\District');
    }

    public function depots(): HasMany
    {
        return $this->hasMany('App\Gpp\Depots\Depot');
    }

    public function rates(): HasMany
    {
        return $this->hasMany('App\Gpp\Rates\Rate');
    }
}
