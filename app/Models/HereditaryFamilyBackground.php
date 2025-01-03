<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HereditaryFamilyBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_sections_id',
        'paternal_family_data',
        'maternal_family_data',
        'observations'
    ];
}
