<?php

namespace App\Gpp\Deliveries;

use Illuminate\Support\Str;
use App\Gpp\ListProducts\ListProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        "code",
        "qr_code",
        "delivery_number",
        "delivery_number_code",
        "delivery_type",
        "customer_name",
        "delivery_receiver",
        "commune_start_id",
        "commune_end_id",
        "locality_start_id",
        "locality_end_id",
        "loading_slip_id",
        "station_id",
        "is_published"
    ];

    public function listProducts(): HasMany
    {
        return $this->hasMany(ListProduct::class);
    }

    public function station(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Stations\Station');
    }

    public function communeStart(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Communes\Commune');
    }

    public function communeEnd(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Communes\Commune');
    }

    public function localityStart(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Localities\Locality');
    }

    public function localityEnd(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Localities\Locality');
    }

    public function loadingSlip(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\LoadingSlips\LoadingSlip');
    }

    public function removeDiff(array $data = [])
    {
        $collection = collect($data);
        $productListKeys = $collection->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['id']];
        })->keys();

        $getFromDb = $this->listProducts()->whereNotIn('id',$productListKeys->all())->delete();
        return true;
    }

    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            if(empty($model->code)) {
                $model->code = Str::uuid();
            }
            
            if(empty($model->delivery_number_code)) {
                $model->delivery_number_code = $model->delivery_number;
            }
        });
    }
    
}
