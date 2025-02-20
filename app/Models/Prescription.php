<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_sections_id',
        'date',
        'time',
        'service',
        'reference',
        'referred_service',
        'diagnosis',
        'indications',
        'physical_folio',
        'medicine_results',
    ];

    protected $casts = [
        'medicine_results' => 'array',
    ];

    public function medicalRecordSection()
    {
        return $this->belongsTo(MedicalRecordSection::class);
    }
}
