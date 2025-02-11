<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'clues',
        'institution_name',
        'unit_name',
        'state',
        'road_name',
        'exterior_number',
        'settlement_type',
        'settlement',
        'postal_code',
    ];
}
