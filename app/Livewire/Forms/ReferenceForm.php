<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Reference;

class ReferenceForm extends Form
{
    #[Validate('required|date')]
    public $date;

    #[Validate('required|date_format:H:i')]
    public $time;

    #[Validate('required|string|in:si,no')]
    public $isUrgent;

    #[Validate('required|string|in:medicina_general,pediatria,ginecologia_obstetricia,cardiologia,dermatologia,neurologia,oftalmologia,otorrinolaringologia,psiquiatria,traumatologia_ortopedia,urologia,endocrinologia,gastroenterologia,neumologia,reumatologia,oncologia')]
    public $reference_unit;

    #[Validate('required|string|in:diagnostico_especializado,tratamiento_especifico,segunda_opinion,procedimientos_quirurgicos,rehabilitacion,atencion_de_urgencia,servicios_de_salud_mental,atencion_materno_infantil')]
    public $reference_by;

    #[Validate('required|string')]
    public $clues;

    #[Validate('required|string')]
    public $entity;

    #[Validate('required|string')]
    public $health_institution;

    #[Validate('required|string')]
    public $destination_unit;

    #[Validate('required|string')]
    public $address;

    #[Validate('required|string')]
    public $service;

    #[Validate('required|boolean')]
    public $patient_on_fast = false;

    #[Validate('required|string')]
    public $reason_for_reference;

    #[Validate('required|string')]
    public $diagnostic_impression;

    #[Validate('required|numeric')]
    public $weight;

    #[Validate('required|numeric')]
    public $height;

    #[Validate('required|numeric')]
    public $imc;

    #[Validate('required|numeric')]
    public $icc;

    #[Validate('required|numeric')]
    public $heartRate;

    #[Validate('required|numeric')]
    public $respiratoryRate;

    #[Validate('required|numeric')]
    public $temperature;

    #[Validate('required|numeric')]
    public $glycemia;

    #[Validate('required|string')]
    public $bloodPressure;

    #[Validate('required|numeric')]
    public $oxygenSaturation;

    #[Validate('required|string')]
    public $physicalFolio;

    public $medicalRecordSectionId;

    public $thereIsConsultation = false;

    public function store()
    {
        $validated = $this->validate();
        
        Reference::create([
            'medical_record_sections_id' => $this->medicalRecordSectionId,
            "date" => $validated['date'],
            "time" => $validated['time'],
            "is_urgent" => $validated['isUrgent'],
            "reference_unit" => $validated['reference_unit'],
            "reference_by" => $validated['reference_by'],
            "clues" => $validated['clues'],
            "entity" => $validated['entity'],
            "health_institution" => $validated['health_institution'],
            "destination_unit" => $validated['destination_unit'],
            "address" => $validated['address'],
            "service" => $validated['service'],
            "patient_on_fast" => $validated['patient_on_fast'],
            "reason_for_reference" => $validated['reason_for_reference'],
            "diagnostic_impression" => $validated['diagnostic_impression'],
            "physical_folio" => $validated['physicalFolio'],
        ]);
    }

}
