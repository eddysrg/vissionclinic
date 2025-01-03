<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationForm extends Model
{
    use HasFactory;

    protected $table = 'identification_form';

    protected $fillable = [
        'medical_record_sections_id',
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
        'landline',
        'cellphone',
        'email',
        'parent',
        'parent_phone',
        'relationship',
        'interrogation',
    ];

    public function medicalRecordSection()
    {
        return $this->belongsTo(MedicalRecordSection::class);
    }
}
