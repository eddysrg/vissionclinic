<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_sections_id',
        'date',
        'time',
        'consultation_type',
        'medical_chart',
        'respiratory_symptom',
        'nutritional_status',
        'current_condition',
        'patient_fasting',
        'weight',
        'height',
        'imc',
        'icc',
        'heart_rate',
        'respiratory_rate',
        'temperature',
        'glycemia',
        'blood_pressure',
        'oxygen_saturation',
        'physical_examination',
        'management_plan',
        'analysis',
        'diagnostic_impression',
        'forecast',
        'diseases',
        'procedures'
    ];

    protected $casts = [
        'diseases' => 'array',
        'procedures' => 'array'
    ];

    public function medicalRecordSection()
    {
       return $this->belongsTo(MedicalRecordSection::class);
    }
}
