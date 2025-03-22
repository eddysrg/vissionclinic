<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'relative',
        'deceased',
        'hta',
        'dm',
        'neoplasms',
        'cardiopathies',
        'ophthalmological',
        'psychiatric',
        'neurological',
        'other',
        'observations',
        'medical_record_id'
    ];

    protected $casts = [
        'deceased' => 'boolean',
        'hta' => 'boolean',
        'dm' => 'boolean',
        'neoplasms' => 'boolean',
        'cardiopathies' => 'boolean',
        'ophthalmological' => 'boolean',
        'psychiatric' => 'boolean',
        'neurological' => 'boolean',
        'other' => 'boolean',
    ];

    public function medicalRecord() {
        return $this->belongsTo(MedicalRecord::class);
    }
}
