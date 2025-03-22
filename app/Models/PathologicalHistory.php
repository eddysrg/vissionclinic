<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologicalHistory extends Model
{
    use HasFactory;

    protected $fillable = ['medical_record_id'];

    public function medicalRecord() {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function exanthematics() {
        return $this->hasMany(Exanthematic::class);
    }

    public function chronicDegenerativeDiseases() {
        return $this->hasMany(ChronicDegenerativeDisease::class);
    }

    public function otherHistories() {
        return $this->hasMany(OtherHistory::class);
    }
}
