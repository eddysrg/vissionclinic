<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'type',
        'comments',
        'status',
        'patient_id',
        'doctor_id',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicalConsultation() {
        return $this->hasOne(MedicalConsultation::class);
    }
}
