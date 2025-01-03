<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'type_record_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicalRecordSections()
    {
        return $this->hasMany(MedicalRecordSection::class);
    }
}
