<?php
namespace App\Gpp\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'comments',
        'measure_id',
        'is_active',
    ];

    public function packages(): HasMany
    {
        return $this->hasMany('App\Gpp\Packages\Package');
    }

    public function rates(): HasMany
    {
        return $this->hasMany('App\Gpp\Rates\Rate');
    }

    public function measure(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Measures\Measure','measure_id');
    }

    /**
     *  Compare le tableau des packages disponibles et supprime ceux qui ny sont pas
     */
    public function removeDiff(array $data = [])
    {
        $collection = collect($data);
        $package_keys = $collection->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['id']];
        })->keys();

        $getPackageFromDb = $this->packages()->whereNotIn('id',$package_keys->all())->delete();
        return true;
    }

}
