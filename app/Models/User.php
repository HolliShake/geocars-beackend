<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'country',
        'address',
        'mobile_number',
        'role',
        'verified_by_admin',
        'is_rejected'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verified_by_admin',
        'is_rejected'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'verified_by_admin' => 'boolean',
        'is_rejected' => 'boolean'
    ];


    protected $appends = [
        'IsAdminVerified',
        'FullName'
    ];

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function getIsAdminVerifiedAttribute() {
        /*
            0, // Admin
            1, // Renter
            2, // Lender
        */

        if ((strcmp($this->role, 'Admin') === 0) || (strcmp($this->role, 'Renter') === 0)) {
            return true;
        }

        return $this->verified_by_admin;
    }

    public function user_access() {
        return $this->hasMany(UserAccess::class);
    }
}
