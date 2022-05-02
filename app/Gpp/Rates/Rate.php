<?php

namespace App\Gpp\Rates;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'product_id',
        'unit_price',
        'locality_start_id',
        'locality_end_id',
        'commune_start_id',
        'commune_end_id',
        'is_active',
    ];

    public function communeStart(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Communes\Commune','commune_start_id');
    }

    public function communeEnd(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Communes\Commune','commune_end_id');
    }

    public function localityStart(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Localities\Locality','locality_start_id');
    }

    public function localityEnd(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Localities\Locality','locality_end_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Products\Product','product_id');
    }


}
