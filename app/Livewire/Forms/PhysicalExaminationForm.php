<?php

namespace App\Livewire\Forms;

use App\Models\MedicalRecord;
use App\Models\PhysicalExamination;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PhysicalExaminationForm extends Form
{

    #[Validate('string|required')]
    public $weight;
    #[Validate('string|required')]
    public $height;
    #[Validate('string|required')]
    public $imc;
    #[Validate('string|required')]
    public $icc;
    #[Validate('string|required')]
    public $frecuencia_cardiaca;
    #[Validate('string|required')]
    public $frecuencia_respiratoria;
    #[Validate('string|required')]
    public $temperatura;
    #[Validate('string|required')]
    public $glucemia;
    #[Validate('string|required')]
    public $presion_arterial;
    #[Validate('string|required')]
    public $saturacion_oxigeno;
    #[Validate('string|required')]
    public $habitus_exterior;
    #[Validate('string|required')]
    public $aparato_respiratorio;
    #[Validate('string|required')]
    public $aparato_respiratorio_status;
    #[Validate('string|required')]
    public $aparato_digestivo;
    #[Validate('string|required')]
    public $aparato_digestivo_status;
    #[Validate('string|required')]
    public $aparato_cardiovascular;
    #[Validate('string|required')]
    public $aparato_cardiovascular_status;
    #[Validate('string|required')]
    public $aparato_genitourinario;
    #[Validate('string|required')]
    public $aparato_genitourinario_status;
    #[Validate('string|required')]
    public $sistema_nervioso;
    #[Validate('string|required')]
    public $sistema_nervioso_status;
    #[Validate('string|required')]
    public $sistema_musculoesqueletico;
    #[Validate('string|required')]
    public $sistema_musculoesqueletico_status;
    #[Validate('string|required')]
    public $craneo;
    #[Validate('string|required')]
    public $craneo_status;
    #[Validate('string|required')]
    public $cara;
    #[Validate('string|required')]
    public $cara_status;
    #[Validate('string|required')]
    public $ojos;
    #[Validate('string|required')]
    public $ojos_status;
    #[Validate('string|required')]
    public $nariz;
    #[Validate('string|required')]
    public $nariz_status;
    #[Validate('string|required')]
    public $boca;
    #[Validate('string|required')]
    public $boca_status;
    #[Validate('string|required')]
    public $cuello;
    #[Validate('string|required')]
    public $cuello_status;
    #[Validate('string|required')]
    public $torax;
    #[Validate('string|required')]
    public $torax_status;
    #[Validate('string|required')]
    public $abdomen;
    #[Validate('string|required')]
    public $abdomen_status;
    #[Validate('string|required')]
    public $extremidades;
    #[Validate('string|required')]
    public $extremidades_status;

    public $medicalRecordId;

    public function store()
    {
        $validated = $this->validate();
        $validated['medical_record_id'] = $this->medicalRecordId;

        PhysicalExamination::updateOrCreate(
            ['medical_record_id' => $this->medicalRecordId],
            $validated
        );
    }

    public function setData() {
        $physicalExaminationRecord = MedicalRecord::find($this->medicalRecordId)->physicalExamination;

        if($this->medicalRecordId && $physicalExaminationRecord) {
            $this->fill(
                $physicalExaminationRecord->only(
                    'weight',
                    'height',
                    'imc',
                    'icc',
                    'frecuencia_cardiaca',
                    'frecuencia_respiratoria',
                    'temperatura',
                    'glucemia',
                    'presion_arterial',
                    'saturacion_oxigeno',
                    'habitus_exterior',
                    'aparato_respiratorio',
                    'aparato_respiratorio_status',
                    'aparato_digestivo',
                    'aparato_digestivo_status',
                    'aparato_cardiovascular',
                    'aparato_cardiovascular_status',
                    'aparato_genitourinario',
                    'aparato_genitourinario_status',
                    'sistema_nervioso',
                    'sistema_nervioso_status',
                    'sistema_musculoesqueletico',
                    'sistema_musculoesqueletico_status',
                    'craneo',
                    'craneo_status',
                    'cara',
                    'cara_status',
                    'ojos',
                    'ojos_status',
                    'nariz',
                    'nariz_status',
                    'boca',
                    'boca_status',
                    'cuello',
                    'cuello_status',
                    'torax',
                    'torax_status',
                    'abdomen',
                    'abdomen_status',
                    'extremidades',
                    'extremidades_status',
                )
            );
        }
    }
}
