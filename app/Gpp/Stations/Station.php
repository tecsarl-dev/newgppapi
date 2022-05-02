<?php

namespace App\Gpp\Stations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'code_company',
        'name',
        'date_commissioning_station',
        'reference_authorization_construction',
        'commune_id',
        'locality_id',
        'is_active',
    ];

    public function commune():BelongsTo
    {
        return $this->belongsTo("App\Gpp\Communes\Commune");
    }

    public function locality():BelongsTo
    {
        return $this->belongsTo("App\Gpp\Localities\Locality");
    }
}
