<?php

namespace App\Gpp\Listproducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_name",
        "quantity",
        "measure_symbol",
        "package_quantity",
        "measure_id",
        "package_id", 
        "product_id",
        "loading_slip_id",
    ];

    public function loadingSlip(): BelongsTo
    {
        return $this->belongsTo("App\Gpp\LoadingSlips\LoadingSlip");
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo("App\Gpp\Deliveries\Delivery");
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo("App\Gpp\Products\Product");
    }

    public function measure(): BelongsTo
    {
        return $this->belongsTo("App\Gpp\Measures\Measure");
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo("App\Gpp\Packages\Package");
    }
}
