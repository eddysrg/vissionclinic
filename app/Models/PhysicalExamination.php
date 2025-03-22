<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExamination extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'habitus_exterior',
        'aparato_respiratorio',
        'aparato_respiratorio_status',
        'aparato_digestivo',
        'aparato_digestivo_status',
        'aparato_cardiovascular',
        'aparato_cardiovascular_status',
        'aparato_genitourinario',
        'aparato_genitourinario_status',
        'sistema_nervioso',
        'sistema_nervioso_status',
        'sistema_musculoesqueletico',
        'sistema_musculoesqueletico_status',
        'craneo',
        'craneo_status',
        'cara',
        'cara_status',
        'ojos',
        'ojos_status',
        'nariz',
        'nariz_status',
        'boca',
        'boca_status',
        'cuello',
        'cuello_status',
        'torax',
        'torax_status',
        'abdomen',
        'abdomen_status',
        'extremidades',
        'extremidades_status',
        'medical_record_id',
    ];

    public function medicalRecord() {
        return $this->belongsTo(MedicalRecord::class);
    }
}
