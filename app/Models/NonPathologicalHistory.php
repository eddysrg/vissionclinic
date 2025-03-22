<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonPathologicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'blood_type',
        'feeding',
        'physical_activity',
        'hygiene',
        'tobacco',
        'ex_smoker',
        'smoker_observations',
        'alcohol',
        'ex_alcoholic',
        'alcoholic_observations',
        'drug_addiction',
        'ex_drug_addict',
        'drug_addiction_observations',
        'type_of_housing',
        'geographical_area',
        'socioeconomic_level',
        'electricity_service',
        'water_service',
        'drainage_service',
        'fauna',
        'fauna_observations',
        'promiscuity',
        'promiscuity_observations',
        'overcrowding',
        'overcrowding_observations',
        'immunizations',
        'immunization_observations',
        'medical_record_id'
    ];

    protected $casts = [
        'ex_smoker' => 'boolean',
        'ex_alcoholic' => 'boolean',
        'ex_drug_addict' => 'boolean',
        'electricity_service' => 'boolean',
        'water_service' => 'boolean',
        'drainage_service' => 'boolean',
    ];

    public function medicalRecord() {
        return $this->belongsTo(MedicalRecord::class);
    }
}
