<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'gender',
        'birthdate',
        'birthplace',
        'phone_number',
        'curp',
        'medical_unit_id',
    ];

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name;
    }

    public function scopeMedicalSections($query, $patientId)
    {
        return $query->with('record.medicalRecordSections')
            ->find($patientId)
            ->record
            ->medicalRecordSections;
    }

    public function medicalUnit()
    {
        return $this->belongsTo(MedicalUnit::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'user_id');
    }

    public function doctorUser()
    {
        return $this->hasOneThrough(User::class, Doctor::class, 'user_id', 'id', 'doctor_id', 'user_id');
    }

    public function record()
    {
        return $this->hasOne(Record::class);
    }
}
