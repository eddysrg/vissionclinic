<?php

namespace App\Livewire\Forms;

use App\Models\MedicalRecord;
use Livewire\Form;
use App\Models\State;
use App\Models\Country;
use App\Models\IdentificationForm;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

class IdentificationCardForm extends Form
{

    #[Validate('required')]
    public $gender_identity;

    #[Validate('required|integer')]
    public $age;

    #[Validate('required|string|max:255')]
    public $country;

    #[Validate('required|string|max:255')]
    public $state;

    #[Validate('required|string')]
    public $zip_code;

    #[Validate('required|string|max:255')]
    public $neighborhood;

    #[Validate('required|string|max:255')]
    public $street;

    #[Validate('required|string|max:255')]
    public $number;

    #[Validate('required|string|max:255')]
    public $religion;

    #[Validate('required|string|max:255')]
    public $schooling;

    #[Validate('required|string|max:255')]
    public $occupation;

    #[Validate('required|string|max:255')]
    public $marital_status;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|max:255')]
    public $parent;

    #[Validate('required|string')]
    public $parents_phone;

    #[Validate('required|string|max:100')]
    public $relationship;

    #[Validate('required|string|max:255')]
    public $interrogation;

    public $medicalRecordId;

    public function store()
    {
        $validated = $this->validate();
        $validated['medical_record_id'] = $this->medicalRecordId;

        IdentificationForm::updateOrCreate(
            ['medical_record_id' => $validated['medical_record_id']],
            $validated
        );
    }

    public function setIdentificationFormData()
    {
        $identificationFormData = MedicalRecord::find($this->medicalRecordId)->identificationForm;

        if($this->medicalRecordId && $identificationFormData) {

            $this->fill(
                $identificationFormData->only(
                    'gender_identity',
                    'age',
                    'country',
                    'state',
                    'zip_code',
                    'neighborhood',
                    'street',
                    'number',
                    'religion',
                    'schooling',
                    'occupation',
                    'marital_status',
                    'email',
                    'parent',
                    'parents_phone',
                    'relationship',
                    'interrogation',
                    'medical_record_id',
                )
            );
        }
    }
}
