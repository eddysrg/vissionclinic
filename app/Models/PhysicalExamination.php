<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExamination extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_sections_id',
        'date',
        'time',
        'weight',
        'height',
        'bmi',
        'chf',
        'heart_rate',
        'respiratory_rate',
        'temperature',
        'glycemia',
        'blood_pressure',
        'oxygen_saturation',
        'external_habitus',
        'test_systems',
        'test_physical'
    ];
}
