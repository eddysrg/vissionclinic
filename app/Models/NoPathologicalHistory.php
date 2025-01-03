<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoPathologicalHistory extends Model
{
    use HasFactory;

    protected $fillable = ['medical_record_sections_id', 'blood_type', 'diet', 'physical_activity' ,'hygiene', 'smoke', 'alcohol', 'drugs', 'housing_type', 'geographical_area', 'socioeconomic_level', 'services', 'fauna', 'promiscuity', 'overcrowding', 'immunizations'];
}
