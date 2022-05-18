<?php

namespace App\Gpp\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "default_create",
        "company_id",
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany("App\Gpp\Permissions\Permission","permission_role");
    }

    // public function myPermisisons(): array
    // {
    //     $permissions = $this->permissions;
    //     return [];
    // }

    public function company(): BelongsTo
    {
        return $this->belongsTo("App\Gpp\Companies\Company");
    }
}
