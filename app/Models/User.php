<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Exception\UnsupportedOperationException;

/**
 * This class represents a User of the system.
 */
class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_last_name',
        'second_last_name',
        'email',
        'telephone',
        'type',
        'password',
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
     * The method to identify the username of a user.
     * @return string
     */
    public function username(): string
    {
        return $this->getAttribute('email');
    }

    public function doctor() : HasOne
    {
        if ($this->getAttribute('type') === "doctor")
            return $this->hasOne(Doctor::class);
        throw new UnsupportedOperationException("The user is not a Doctor.");
    }

    public function patient() : HasOne
    {
        if ($this->getAttribute('type') === "patient")
            return $this->hasOne(Patient::class);
        throw new UnsupportedOperationException("The user is not a Patient.");
    }

    public function appointments() : HasMany
    {
        if ($this->getAttribute('type') === "patient")
            return $this->patient->hasMany(Appointment::class);
        elseif ($this->getAttribute('type') === "doctor")
            return $this->doctor->hasMany(Appointment::class);

        throw new UnsupportedOperationException('This user cannot have Appointments');
    }
}
