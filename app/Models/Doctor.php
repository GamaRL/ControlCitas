<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'professional_license',
        'speciality'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schedules() : HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function appointments() : HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
