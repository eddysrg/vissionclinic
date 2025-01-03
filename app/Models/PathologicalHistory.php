<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologicalHistory extends Model
{
    use HasFactory;

    protected $fillable = ['medical_record_sections_id', 'exanthematic_diseases', 'chronic_degenerative_diseases', 'other_diseases'];


    public function medicalRecordSection()
    {
        return $this->belongsTo(MedicalRecordSection::class);
    }
    
}
