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
}
