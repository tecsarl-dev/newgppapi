<?php
namespace App\Gpp\Measures;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Measure extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
    ];
    
    public $timestamps = false;

    public function products(): HasMany
    {
        return $this->hasMany('App\Gpp\Products\Product');
    }
}
