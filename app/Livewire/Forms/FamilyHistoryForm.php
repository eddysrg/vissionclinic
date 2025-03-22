<?php

namespace App\Livewire\Forms;

use App\Models\FamilyHistory;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FamilyHistoryForm extends Form
{
    public string $observations = '';
    public array $paternosFamilyData = [];
    public array $maternosFamilyData = [];

    public int $medicalRecordId;

    public function store()
    {
        foreach ($this->paternosFamilyData as $paterno) {
            $paterno['observations'] = $this->observations;
            $paterno['medical_record_id'] = $this->medicalRecordId;
            FamilyHistory::updateOrCreate([
                'relative' => $paterno['relative'],
                'medical_record_id' => $paterno['medical_record_id'],
            ], $paterno);
        }

        foreach ($this->maternosFamilyData as $materno) {
            $materno['observations'] = $this->observations;
            $materno['medical_record_id'] = $this->medicalRecordId;
            FamilyHistory::updateOrCreate([
                'relative' => $materno['relative'],
                'medical_record_id' => $materno['medical_record_id'],
            ], $materno);
        }
    }

    public function setFamilyHistoryData()
    {
        $familyHistoryData = MedicalRecord::find($this->medicalRecordId)->familyHistory->toArray();

        if($this->medicalRecordId && $familyHistoryData) {
            $this->paternosFamilyData = [];
            $this->maternosFamilyData = [];
            $this->paternosFamilyData[] = $familyHistoryData[0];
            $this->paternosFamilyData[] = $familyHistoryData[1];
            $this->paternosFamilyData[] = $familyHistoryData[2];
            $this->paternosFamilyData[] = $familyHistoryData[3];
            $this->maternosFamilyData[] = $familyHistoryData[4];
            $this->maternosFamilyData[] = $familyHistoryData[5];
            $this->maternosFamilyData[] = $familyHistoryData[6];
            $this->maternosFamilyData[] = $familyHistoryData[7];

            $this->observations = $familyHistoryData[0]['observations'];
        }
    }
}
