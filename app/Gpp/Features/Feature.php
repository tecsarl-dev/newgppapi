<?php

namespace App\Gpp\Features;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "guard",
        "type_company",
        "default_create",
    ];

    public function permissions(): HasMany
    {
        return $this->hasMany("App\Gpp\Permissions\Permission");
    }
}
