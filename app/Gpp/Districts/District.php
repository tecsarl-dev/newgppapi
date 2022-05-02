<?php

namespace App\Gpp\Districts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'is_active',
        'commune_id',
    ];

    public function commune(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Communes\Commune');
    }
}
