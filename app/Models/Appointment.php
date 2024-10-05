<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_date',
        'appointment_time',
        'appointment_type',
        'appointment_comments',
        'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
