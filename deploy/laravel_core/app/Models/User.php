<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'business_name',
        'business_address',
        'business_phone',
        'business_email',
        'gstin',
        'bnpl_active',
        'credit_limit',
        'current_due',
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
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function retailerProfile()
    {
        return $this->hasOne(Retailer::class, 'user_id');
    }

    protected static function booted()
    {
        static::created(function ($user) {
            if ($user->role === 'admin') {
                \App\Models\Warehouse::create([
                    'user_id' => $user->id,
                    'name' => 'Main',
                    'location' => 'Default Godown',
                ]);
            }
        });
    }
}
