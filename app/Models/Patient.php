<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'doctor_id',
        'name',
        'father_last_name',
        'mother_last_name',
        'gender',
        'birthdate',
        'birthplace',
        'phone_number',
        'curp'
    ];

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'user_id');
    }

    public function doctorUser()
    {
        return $this->hasOneThrough(User::class, Doctor::class, 'user_id', 'id', 'doctor_id', 'user_id');
    }

    public function record()
    {
        return $this->hasOne(Record::class);
    }
}
