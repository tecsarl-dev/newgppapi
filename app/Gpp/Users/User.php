<?php

namespace App\Gpp\Users;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role_id',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 
     * 
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo('App\Gpp\Companies\Company');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany('App\Gpp\Roles\Role','role_user');
    }


    /**
     * 
     * 
     * 
     */
    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            $model->password = bcrypt($model->password);
        });
    }

}
