<?php

namespace App\Gpp\Permissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "guard",
        "default_create",
        "role_id",
    ];

    public function role(): BelongsToMany
    {
        return $this->belongsToMany("App\Gpp\Roles\Role","permission_role");
    }

}
