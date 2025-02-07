<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_sections_id',
        'date',
        'time',
        'service',
        'is_urgent',
        'sample_type',
        'diagnosis',
        'special_studies',
        'folio',
        'hematology',
        'coagulation',
        'clinicalChemistry',
        'immunology',
        'cytology',
        'urologyAndCoprology',
        'microbiology'
    ];

    protected $casts = [
        'hematology' => 'array',
        'coagulation' => 'array',
        'clinicalChemistry' => 'array',
        'immunology' => 'array',
        'cytology' => 'array',
        'urologyAndCoprology' => 'array',
        'microbiology' => 'array'
    ];

    public function medicalRecordSection()
    {
       return $this->belongsTo(MedicalRecordSection::class);
    }
}
