<?php

use Livewire\Volt\Component;

new class extends Component {

    public $patient;
    public $medicalConsultation;
    public $appointments = [];
    public $medicalConsultations = [];

    public function setMedicalConsultations() {
        if(!$this->patient->appointments->isEmpty()) {
            $this->appointments = $this->patient->appointments;

            foreach ($this->appointments as $appointment) {
                if($appointment->medicalConsultation) {
                    $this->medicalConsultations[] = $appointment->medicalConsultation;
                }
            }

            $this->medicalConsultation = $this->medicalConsultations[0] ?? '';
        }
    }

    public function updateVitalSigns($index)
    {
        $this->medicalConsultation = $this->medicalConsultations[$index];
    }

    public function mount() {
        $this->setMedicalConsultations();
    }
    //
}; ?>

<section
    x-data="{showDates: false}"
    class="mt-3 border relative">
    <div class="flex items-center justify-between bg-[#174075] text-white p-2">
        <h2 class="uppercase">Signos vitales</h2>
        <i
            x-on:click="showDates = true"
            class="fa-solid fa-plus text-sm text-[#174075] bg-white aspect-square px-1 rounded-full cursor-pointer"></i>
    </div>

    <x-vital-sign vitalSign='Estatura' icon='height.png' value='{{$medicalConsultation->height ?? 0}}' unit='m' color='text-[#03BCF6]' />
    <x-vital-sign vitalSign='Peso' icon='weight.png' value='{{$medicalConsultation->weight ?? 0}}' unit='Kg' color='text-[#B755E5]' />
    <x-vital-sign vitalSign='IMC' icon='bmi.png' value='{{$medicalConsultation->imc ?? 0}}' unit='IMC' color='text-[#A6D61D]' />
    <x-vital-sign vitalSign='Temperatura' icon='temperature.png' value='{{$medicalConsultation->temperatura ?? 0}}' unit='°C'
                  color='text-[#E11010]' />
    <x-vital-sign vitalSign='Frec. Respiratoria' icon='respiratory.png' value='{{$medicalConsultation->frecuencia_respiratoria ?? 0}}' unit='rpm'
                  color='text-[#1DC724]' />
    <x-vital-sign vitalSign='Presión Arterial' icon='bloodpressure.png' value='{{$medicalConsultation->presion_arterial ?? 0}}' unit='mmHg'
                  color='text-[#23CECE]' />
    <x-vital-sign vitalSign='Frec. Cardiaca' icon='heart_rate.png' value='{{$medicalConsultation->frecuencia_cardiaca ?? 0}}' unit='lpm'
                  color='text-[#CC17AF]' border='' />

    <div
        x-show="showDates"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        x-on:click.outside="showDates = false"
        class="w-full h-32 bg-[#174075] rounded absolute top-0 right-[-300px] p-5 overflow-scroll text-white z-20" style="display: none">
        <h4 class="text-center text-sm mb-3">Últimos signos vitales</h4>
        <div class="flex flex-col justify-center gap-3">
            @forelse($medicalConsultations as $index => $medicalConsultation)
                <button type="button" wire:click="updateVitalSigns({{$index}})" class="text-sm font-semibold text-center cursor-pointer">
                    {{$medicalConsultation->date->format('d/m/Y')}}
                </button>
            @empty
                <p class="text-center">No hay consultas recientes</p>
            @endforelse
        </div>
    </div>
</section>
