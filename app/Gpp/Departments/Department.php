<?php

namespace App\Gpp\Departments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'country_id',
        'is_active',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Countries\Country');
    }
}
