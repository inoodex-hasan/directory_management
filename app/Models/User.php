<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use HasinHayder\Tyro\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use HasinHayder\Tyro\Concerns\HasTyroRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use HasApiTokens, HasTyroRoles;


    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
    'is_admin' => 'boolean', 
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function links()
{
    return $this->hasMany(Link::class);
}

public function subscription()
{
    return $this->hasOne(Subscription::class);
}

public function isPaid()
{
    return $this->subscription && $this->subscription->type === 'paid' && $this->subscription->expires_at > now();
}

// public function role()
// {
//     return $this->belongsTo(Role::class, 'role_id'); 
// }

public function isAdmin(): bool
{
    return (bool) $this->is_admin;
}

protected static function booted()
{
    static::created(function ($user) {
        if ($user->id === 1) {
            $user->update(['is_admin' => true]);
        }
    });
}
}
