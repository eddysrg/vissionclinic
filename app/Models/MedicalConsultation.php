<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalConsultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'type_of_consultation',
        'medical_card',
        'respiratory_symptoms',
        'nutritional_status',
        'reason_for_consultation',
        'fasting_patient',
        'weight',
        'height',
        'imc',
        'icc',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'temperatura',
        'glucemia',
        'presion_arterial',
        'saturacion_oxigeno',
        'physical_examination',
        'management_plan',
        'analysis',
        'diagnostic_impression',
        'prognosis',
        'diseases',
        'procedures',
        'appointment_id'
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
        'fasting_patient' => 'boolean',
        'diseases' => 'array',
        'procedures' => 'array',
    ];

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

}
