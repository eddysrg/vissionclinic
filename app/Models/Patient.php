<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'doctor',
        'patient_name',
        'fathers_last_name',
        'mothers_last_name',
        'gender',
        'age',
        'phone_number',
    ];
}
