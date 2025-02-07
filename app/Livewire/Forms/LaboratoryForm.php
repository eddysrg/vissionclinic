<?php

namespace App\Livewire\Forms;

use App\Models\Laboratory;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LaboratoryForm extends Form
{
    #[Validate('required|date')]
    public $date;

    #[Validate('required|date_format:H:i')]
    public $time;

    #[Validate('required|in:hematologia,coagulacion,quimica_clinica,inmunologia,citologia,urologia_coprologia,microbiologia')]
    public $service;

    #[Validate('required|in:si,no')]
    public $isUrgent;

    #[Validate('required|in:sangre,orina,heces,saliva,tejido,liquido_cefalorraquideo,liquido_sinovial,liquido_pleural,liquido_pericardico,esputo,secrecion_vaginal,liquido_seminal')]
    public $sampleType;

    #[Validate('required|string')]
    public $diagnosis;

    #[Validate('required|string')]
    public $specialStudies;

    #[Validate('required|string')]
    public $folio;

    public $hematology = [];
    public $coagulation = [];
    public $clinicalChemistry = [];
    public $immunology = [];
    public $cytology = [];
    public $urologyAndCoprology = [];
    public $microbiology = [];
    public $medicalRecordSectionId;
    

    public function store()
    {
        $validated = $this->validate();

        Laboratory::create([
            'medical_record_sections_id' => $this->medicalRecordSectionId,
            'date' => $validated['date'],
            'time' => $validated['time'],
            'service' => $validated['service'],
            'is_urgent' => $validated['isUrgent'],
            'sample_type' => $validated['sampleType'],
            'diagnosis' => $validated['diagnosis'],
            'special_studies' => $validated['specialStudies'],
            'folio' => $validated['folio'],
            'hematology' => $this->hematology,
            'coagulation' => $this->coagulation,
            'clinicalChemistry' => $this->clinicalChemistry,
            'immunology' => $this->immunology,
            'cytology' => $this->cytology,
            'urologyAndCoprology' => $this->urologyAndCoprology,
            'microbiology' => $this->microbiology
        ]);
    }
}
