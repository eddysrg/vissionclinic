<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecordSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'name',
    ];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function identificationForm()
    {
        return $this->hasOne(IdentificationForm::class, 'medical_record_sections_id');
    }

    public function medicalConsultation()
    {
        return $this->hasMany(Consultation::class, 'medical_record_sections_id');
    }

    public function laboratories()
    {
        return $this->hasMany(Laboratory::class, 'medical_record_sections_id');
    }

    public function references()
    {
        return $this->hasMany(Reference::class, 'medical_record_sections_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'medical_record_sections_id');
    }

    public function digitalFiles()
    {
        return $this->hasMany(DigitalFile::class, 'medical_record_sections_id');
    }
}
