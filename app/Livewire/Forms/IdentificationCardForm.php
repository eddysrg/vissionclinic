<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\State;
use App\Models\Country;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

class IdentificationCardForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|string|max:255')]
    public $paternal_surname;

    #[Validate('required|string|max:255')]
    public $maternal_surname;

    #[Validate('required|in:H,M')]
    public $gender;

    #[Validate('required')]
    public $gender_identity;

    #[Validate('required|integer')]
    public $age;

    #[Validate('required|date|before:today')]
    public $birthdate;

    #[Validate('required|string|max:255')]
    public $birthplace;

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

    #[Validate('required|string')]
    public $landline;

    #[Validate('required|string')]
    public $cellphone;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|max:255')]
    public $parent;

    #[Validate('required|string')]
    public $parent_phone;

    #[Validate('required|string|max:100')]
    public $relationship;

    #[Validate('required|string|max:255')]
    public $interrogation;

    public $sectionId;

    public function store()
    {
        $validated = $this->validate();
        

        // dd($validated);

        DB::table('identification_form')->updateOrInsert(
            [
                'email' => $validated['email']
            ],
            [
                'medical_record_sections_id' => $this->sectionId,
                'gender_identity' => $validated['gender_identity'],
                'age' => $validated['age'],
                'country' => $validated['country'],
                'state' => $validated['state'],
                'zip_code' => $validated['zip_code'],
                'neighborhood' => $validated['neighborhood'],
                'street' => strtoupper($validated['street']),
                'number' => $validated['number'],
                'religion' => $validated['religion'],
                'schooling' => $validated['schooling'],
                'occupation' => $validated['occupation'],
                'marital_status' => $validated['marital_status'],
                'landline' => $validated['landline'],
                'cellphone' => $validated['cellphone'],
                'email' => $validated['email'],
                'parent' => strtoupper($validated['parent']),
                'parent_phone' => $validated['parent_phone'],
                'relationship' => $validated['relationship'],
                'interrogation' => $validated['interrogation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

    }
}
