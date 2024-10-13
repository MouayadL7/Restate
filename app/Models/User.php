<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     * The 'fillable' property defines the attributes that can be mass assigned
     * when creating or updating a User model instance.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'phone_number_verified',
        'password',
        'location',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     *
     * The 'casts' property specifies how certain attributes should be automatically
     * converted when retrieving them from the database. Here, 'location' is cast to JSON,
     * 'password' is cast to Hashed.
     */
    protected $casts = [
        'password' => 'hashed',
        'location' => 'json',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    public function device_tokens(): HasMany
    {
        return $this->hasMany(DeviceToken::class);
    }

    public function routeNotificationForFcm($notification = null)
    {
        return $this->device_tokens()->pluck('token')->toArray();
    }
}
