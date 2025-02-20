<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_sections_id',
        'name',
        'path',
        'extension',
        'size',
    ];

    public function medicalRecordSection()
    {
        return $this->belongsTo(MedicalRecordSection::class);
    }
}
