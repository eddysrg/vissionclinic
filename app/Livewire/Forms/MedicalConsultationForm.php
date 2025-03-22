<?php

namespace App\Livewire\Forms;

use App\Models\MedicalConsultation;
use Carbon\Carbon;
use Livewire\Form;
use App\Models\Diagnosis;
use App\Models\Consultation;
use Livewire\Attributes\{Validate, On};

class MedicalConsultationForm extends Form
{

    public $diseases = [];
    public $procedures = [];
    public $appointmentId;

    #[Validate('required|date')]
    public $date;

    #[Validate('required|date_format:H:i')]
    public $time;

    #[Validate('required|in:chronic,healthy,planning,sexually_transmitted_diseases,other_diseases')]
    public $type_of_consultation;

    #[Validate('required|in:yes,no')]
    public $medical_card;

    #[Validate('required|in:yes,no')]
    public $respiratory_symptoms;

    #[Validate('required|in:underweight,normal_weight,overweight,obesity_one,obesity_two,obesity_three')]
    public $nutritional_status;

    #[Validate('required|string')]
    public $reason_for_consultation;

    #[Validate('required|boolean')]
    public $fasting_patient = false;

    #[Validate('required|numeric')]
    public $weight;

    #[Validate('required|numeric')]
    public $height;

    #[Validate('required|numeric')]
    public $imc;

    #[Validate('required|numeric')]
    public $icc;

    #[Validate('required|numeric')]
    public $frecuencia_cardiaca;

    #[Validate('required|numeric')]
    public $frecuencia_respiratoria;

    #[Validate('required|numeric')]
    public $temperatura;

    #[Validate('required|numeric')]
    public $glucemia;

    #[Validate('required|string')]
    public $presion_arterial;

    #[Validate('required|numeric')]
    public $saturacion_oxigeno;

    #[Validate('required|string')]
    public $physical_examination;

    #[Validate('required|string')]
    public $management_plan;

    #[Validate('required|string')]
    public $analysis;

    #[Validate('required|string')]
    public $diagnostic_impression;

    #[Validate('required|string')]
    public $prognosis;


    public function store()
    {
        $validated = $this->validate();
        $validated['diseases'] = $this->diseases;
        $validated['procedures'] = $this->procedures;
        $validated['appointment_id'] = $this->appointmentId;
        MedicalConsultation::create($validated);
    }


}
