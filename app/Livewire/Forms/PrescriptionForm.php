<?php

namespace App\Livewire\Forms;

use App\Models\Prescription;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PrescriptionForm extends Form
{
    #[Validate('required|date')]
    public $date;

    #[Validate('required|date_format:H:i')]
    public $time;

    #[Validate('required|string')]
    public $service;

    #[Validate('required|string')]
    public $reference;

    #[Validate('required|string')]
    public $referredService;

    #[Validate('required|string')]
    public $diagnosis;

    #[Validate('required|string')]
    public $indications;

    #[Validate('required|string')]
    public $physicalFolio;

    public $medicineResults = [];

    public $medicalRecordSectionId;

    public function store()
    {
        $validated = $this->validate();

        Prescription::create([
            'medical_record_sections_id' => $this->medicalRecordSectionId,
            'date' => $validated['date'],
            'time' => $validated['time'],
            'service' => $validated['service'],
            'reference' => $validated['reference'],
            'referred_service' => $validated['referredService'],
            'diagnosis' => $validated['diagnosis'],
            'indications' => $validated['indications'],
            'physical_folio' => $validated['physicalFolio'],
            'medicine_results' => $this->medicineResults,
        ]);
    }
}
