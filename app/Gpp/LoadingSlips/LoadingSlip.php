<?php

namespace App\Gpp\LoadingSlips;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoadingSlip extends Model
{
    use HasFactory;

    // protected $with = ["transporter","depot","truck","truckTrailer","listProducts"];

    protected $fillable = [
        "code",
        "qr_code",
        "loading_number",
        "loading_number_code",
        "loading_type",
        "driver_name",
        "driver_tel",
        "ref_avd",
        "ref_other",
        "is_published",
        "depot_id",
        "transporter_id",
        "truck_id",
        "truck_trailer_id",
    ];

    public function listProducts(): HasMany
    {
        return $this->hasMany('App\Gpp\ListProducts\ListProduct');
    }

    public function transporter(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Companies\Company', "transporter_id");
    }

    public function truck(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Trucks\Truck', "truck_id");
    }

    public function truckTrailer(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Trucks\Truck', "truck_trailer_id");
    }

    public function depot(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Depots\Depot', "depot_id");
    }

    /**
     *  Compare le tableau des produits disponibles et supprime ceux qui ny sont pas
     */
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
            
            if(empty($model->loading_number_code)) {
                $model->loading_number_code = $model->loading_number;
            }
        });
    }
}
