<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Equipment;
use App\Models\Challenge;
use App\Models\UserChallengeLogger;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'role_id',
        'email',
        'image',
        'zipcode',
        'garanty',
        'password',
        'created_at',
        'updated_at',
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
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'image' => 'images/avatar.png',
        'role_id' => Role::USER
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }

    public function completedChallenges()
    {
        return $this->belongsToMany(Challenge::class, 'chellenge_user', 'user_id', 'challenge_id')->withPivot(['created_at']);
    }

    public function challengeLogs()
    {
        return $this->hasMany(UserChallengeLogger::class, 'user_id');
    }
}
