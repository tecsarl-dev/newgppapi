<?php

namespace App\Gpp\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $with = ['legalForm'];

    protected $fillable = [
        'type_company',
        'name',
        'ifu',
        'rccm',
        'social_capital',
        'legal_form_id',
        'email',
        'phone',
        'address_physical',
    ];

    public function legalForm(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\LegalForms\LegalForm');
    }
}
