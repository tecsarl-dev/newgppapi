<?php

namespace App\Gpp\Packages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Products\Product');
    }

    
}
