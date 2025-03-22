<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'degree',
        'name',
        'last_name',
        'gender',
        'birthdate',
        'phone_number',
        'email',
        'rfc',
        'curp',
        'username',
        'password',
        'medical_unit_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullNameAttribute()
    {
        $name = ucwords(strtolower($this->name));
        $last_name = ucwords(strtolower($this->last_name));
        $degree = $this->degree ?? '';

        return "{$degree} {$name} {$last_name}";
    }

    public function medicalUnit()
    {
        return $this->belongsTo(MedicalUnit::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }
}
