<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_sections_id',
        "date",
        "time",
        "is_urgent",
        "reference_unit",
        "reference_by",
        "clues",
        "entity",
        "health_institution",
        "destination_unit",
        "address",
        "service",
        "patient_on_fast",
        "reason_for_reference",
        "diagnostic_impression",
        "physical_folio",
    ];

    public function medicalRecordSection()
    {
       return $this->belongsTo(MedicalRecordSection::class);
    }
}
