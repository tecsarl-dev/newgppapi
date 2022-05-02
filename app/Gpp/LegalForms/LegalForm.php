<?php

namespace App\Gpp\LegalForms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LegalForm extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'sigle',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany('App\Gpp\Companies\Company');
    }
}
