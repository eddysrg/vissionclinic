<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender_identity',
        'age',
        'country',
        'state',
        'zip_code',
        'neighborhood',
        'street',
        'number',
        'religion',
        'schooling',
        'occupation',
        'marital_status',
        'email',
        'parent',
        'parents_phone',
        'relationship',
        'interrogation',
        'medical_record_id',
    ];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
