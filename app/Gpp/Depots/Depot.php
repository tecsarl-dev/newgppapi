<?php
namespace App\Gpp\Depots;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Depot extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'comments',
        'capacity',
        'locality_id',
        'commune_id',
        'is_active',
    ];

    public function locality(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Localities\Locality','locality_id');
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Communes\Commune','commune_id');
    }
    
}
