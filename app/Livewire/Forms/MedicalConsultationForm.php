<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Diagnosis;
use App\Models\Consultation;
use Livewire\Attributes\Validate;

class MedicalConsultationForm extends Form
{

    public $diseases = [];
    public $procedures = [];
    public $medicalRecordSectionId;
    
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

    #[Validate('required|boolean')]
    public $patientFasting = false;

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
    public $physicalExamination;

    #[Validate('required|string')]
    public $managementPlan;

    #[Validate('required|string')]
    public $analysis;

    #[Validate('required|string')]
    public $diagnosticImpression;

    #[Validate('required|string')]
    public $forecast;


    public function store()
    {
        $validated = $this->validate();

        Consultation::create([
            'medical_record_sections_id' => $this->medicalRecordSectionId,
            'date' => $validated['date'],
            'time' => $validated['time'],
            'consultation_type' => $validated['consultationType'],
            'medical_chart' => $validated['medicalChart'],
            'respiratory_symptom' => $validated['respiratorySymptom'],
            'nutritional_status' => $validated['nutritionalStatus'],
            'current_condition' => $validated['currentCondition'],
            'patient_fasting' => $validated['patientFasting'],
            'weight' => $validated['weight'],
            'height' => $validated['height'],
            'imc' => $validated['imc'],
            'icc' => $validated['icc'],
            'heart_rate' => $validated['heartRate'],
            'respiratory_rate' => $validated['respiratoryRate'],
            'temperature' => $validated['temperature'],
            'glycemia' => $validated['glycemia'],
            'blood_pressure' => $validated['bloodPressure'],
            'oxygen_saturation' => $validated['oxygenSaturation'],
            'physical_examination' => $validated['physicalExamination'],
            'management_plan' => $validated['managementPlan'],
            'analysis' => $validated['analysis'],
            'diagnostic_impression' => $validated['diagnosticImpression'],
            'forecast' => $validated['forecast'],
            'diseases' => $this->diseases,
            'procedures' => $this->procedures
        ]);

    }

    public function setMedicalData()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        $this->time = Carbon::now()->format('H:i');
    }
}
