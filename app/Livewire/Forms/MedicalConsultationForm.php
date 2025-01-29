<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Diagnosis;
use Livewire\Attributes\Validate;

class MedicalConsultationForm extends Form
{

    public $diseases = [];
    
    #[Validate('required|date')]
    public $date;

    #[Validate('required|date_format:H:i')]
    public $time;

    #[Validate('required|in:chronic,healthy,planning,sexually_transmitted_diseases,other_diseases')]
    public $consultationType;

    #[Validate('required|in:yes,no')]
    public $medicalChart;

    #[Validate('required|in:yes,no')]
    public $respiratorySymptom;

    #[Validate('required|in:underweight,normal_weight,overweight,obesity_one,obesity_two,obesity_three')]
    public $nutritionalStatus;

    #[Validate('required|string')]
    public $currentCondition;

    #[Validate('required')]
    public $patientFasting = true;

    #[Validate('required|numeric')]
    public $weight;

    #[Validate('required|numeric')]
    public $height;

    #[Validate('required|numeric')]
    public $imc;

    #[Validate('required|string')]
    public $icc;

    #[Validate('required|string')]
    public $heartRate;

    #[Validate('required|string')]
    public $respiratoryRate;

    #[Validate('required|string')]
    public $temperature;

    #[Validate('required|string')]
    public $glycemia;

    #[Validate('required|string')]
    public $bloodPressure;

    #[Validate('required|string')]
    public $oxygenSaturation;

    #[Validate('required|string')]
    public $physicalExamination;

    #[Validate('required|string')]
    public $managementPlan;

    #[Validate('required|string')]
    public $analysis;

    #[Validate('required|string')]
    public $diagnosticImpression;

    #[Validate('required|string')]
    public $forecast;

    #[Validate('required|string')]
    public $prueba;


    public function store()
    {
        $this->validate();
    }

    public function setMedicalData()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        $this->time = Carbon::now()->format('H:i');
    }
}
