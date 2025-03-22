<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'record_id',
    ];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function identificationForm()
    {
        return $this->hasOne(IdentificationForm::class);
    }

    public function familyHistory()
    {
        return $this->hasMany(FamilyHistory::class);
    }

    public function pathologicalHistory() {
        return $this->hasOne(PathologicalHistory::class);
    }

    public function nonPathologicalHistory() {
        return $this->hasOne(NonPathologicalHistory::class);
    }

    public function physicalExamination() {
        return $this->hasOne(PhysicalExamination::class);
    }
}
