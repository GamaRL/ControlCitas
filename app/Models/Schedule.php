<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'date',
        'hour',
    ];

    public function doctor() : BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function appointment() : HasOne
    {
        return $this->hasOne(Appointment::class);
    }
}
