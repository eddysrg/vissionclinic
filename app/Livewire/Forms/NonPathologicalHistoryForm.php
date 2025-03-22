<?php

namespace App\Livewire\Forms;

use App\Models\MedicalRecord;
use App\Models\NonPathologicalHistory;
use Faker\Provider\Medical;
use Livewire\Attributes\Validate;
use Livewire\Form;

class NonPathologicalHistoryForm extends Form
{
    #[Validate('string|required')]
    public $blood_type;
    #[Validate('string|required')]
    public $feeding;
    #[Validate('string|required')]
    public $physical_activity;
    #[Validate('string|required')]
    public $hygiene;
    #[Validate('string|required')]
    public $tobacco;
    #[Validate('boolean|required')]
    public bool $ex_smoker = false;
    #[Validate('string|nullable')]
    public $smoker_observations;
    #[Validate('string|required')]
    public $alcohol;
    #[Validate('boolean|required')]
    public $ex_alcoholic = false;
    #[Validate('string|nullable')]
    public $alcoholic_observations;
    #[Validate('string|required')]
    public $drug_addiction;
    #[Validate('boolean|required')]
    public $ex_drug_addict = false;
    #[Validate('string|nullable')]
    public $drug_addiction_observations;
    #[Validate('string|required')]
    public $type_of_housing;
    #[Validate('string|required')]
    public $geographical_area;
    #[Validate('string|required')]
    public $socioeconomic_level;
    #[Validate('boolean|required')]
    public $electricity_service = false;
    #[Validate('boolean|required')]
    public $water_service = false;
    #[Validate('boolean|required')]
    public $drainage_service = false;
    #[Validate('string|required')]
    public $fauna;
    #[Validate('string|nullable')]
    public $fauna_observations;
    #[Validate('string|required')]
    public $promiscuity;
    #[Validate('string|nullable')]
    public $promiscuity_observations;
    #[Validate('string|required')]
    public $overcrowding;
    #[Validate('string|nullable')]
    public $overcrowding_observations;
    #[Validate('string|required')]
    public $immunizations;
    #[Validate('string|nullable')]
    public $immunization_observations;
    public $medicalRecordId;

    public function store() {
        $this->validate();

        NonPathologicalHistory::updateOrCreate(
            ['medical_record_id' => $this->medicalRecordId],
            $this->all()
        );
    }

    public function setData() {
        $nonPathologicalHistory = MedicalRecord::find($this->medicalRecordId)->nonPathologicalHistory;

        if($this->medicalRecordId && $nonPathologicalHistory) {
            $this->fill(
                $nonPathologicalHistory->only(
                    'blood_type',
                    'feeding',
                    'physical_activity',
                    'hygiene',
                    'tobacco',
                    'ex_smoker',
                    'smoker_observations',
                    'alcohol',
                    'ex_alcoholic',
                    'alcoholic_observations',
                    'drug_addiction',
                    'ex_drug_addict',
                    'drug_addiction_observations',
                    'type_of_housing',
                    'geographical_area',
                    'socioeconomic_level',
                    'electricity_service',
                    'water_service',
                    'drainage_service',
                    'fauna',
                    'fauna_observations',
                    'promiscuity',
                    'promiscuity_observations',
                    'overcrowding',
                    'overcrowding_observations',
                    'immunizations',
                    'immunization_observations'
                )
            );
        }
    }
}
