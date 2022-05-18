<?php

namespace App\Gpp\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function users(): HasMany
    {
        return $this->hasMany('App\Gpp\Users\User');
    }

    public function roles(): HasMany
    {
        return $this->hasMany('App\Gpp\Roles\Role');
    }

    public function legalForm(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\LegalForms\LegalForm');
    }

    public function trucks(): HasMany
    {
        return $this->hasMany('App\Gpp\Trucks\Truck',"transporter_id");
    }

    public function active_trucks() 
    {
        return $this->trucks()->where('is_active','=', 1);
    }
}
