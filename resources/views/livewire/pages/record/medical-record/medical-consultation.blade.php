<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title, On};
use App\Models\{Patient, Appointment};
use Carbon\Carbon;
use App\Livewire\Forms\MedicalConsultationForm;
use Illuminate\View\View;


new
#[Title('Consulta médica - Vission Clinic ECE')]
class extends Component {
    public $patient;
    public $appointments;

    protected $listeners = ['setDiagnosisOfDiseases', 'removeDisease', 'setMedicalProcedures', 'removeProcedure'];

    public MedicalConsultationForm $form;

    public function save()
    {
        if(empty($this->form->diseases)) {
            $this->dispatch('diagnosis-alert', message: "Debes seleccionar un diagnóstico de enfermedad");
            return;
        }

        $this->form->store();

        $route = route('dashboard.record.medical-consultation', ['id' => $this->patient->id]);
        $this->dispatch('show-noti', message: 'Consulta médica registrada con éxito', link: $route);
    }

    public function setDiagnosisOfDiseases($diagnosisOfDiseases)
    {
        $this->form->diseases = $diagnosisOfDiseases;
    }

    public function removeDisease($id)
    {
        $this->form->diseases = collect($this->form->diseases)->reject(fn($item) => $item['id'] === $id)->toArray();
    }

    public function setMedicalProcedures($medicalProcedures)
    {
        $this->form->procedures = $medicalProcedures;
    }

    public function removeProcedure($id)
    {
        $this->form->procedures = collect($this->form->procedures)->reject(fn($item) => $item['id'] === $id)->toArray();
    }

    #[On('set-medical-data')]
    public function setMedicalData()
    {
        $selectedAppointment = Appointment::find($this->form->appointmentId);
        $this->form->date = $selectedAppointment->date->format('Y-m-d');
        $this->form->time = $selectedAppointment->time->format('H:i');
        $this->form->type_of_consultation = $selectedAppointment->type;
    }

    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
        //$this->form->setMedicalData();
        $this->appointments = $this->patient->appointments;
    }

    public function rendering(View $view)
    {
        $view
            ->layout('components.layout.record', [
                'patient' => $this->patient,
                'hasAppointment' => !$this->patient->appointments->isEmpty(),
            ]);
    }

}; ?>

<x-slot:patientID>
    {{$this->patient->id}}
</x-slot>

<div
    x-on:diagnosis-alert.window="alert($event.detail.message)"
    x-on:diagnosis-failed.window="alert($event.detail.message)">

    <x-record-notification/>

    <h2 class="text-3xl text-[#174075]">Consulta Médica</h2>

    <form wire:submit='save'>
        <fieldset class="grid grid-cols-3 gap-5 my-8">

            <div class="col-span-3 flex flex-col">
                <label for="" class="text-xs">Cita de la consulta</label>
                <select class="text-sm rounded border-zinc-400" wire:model="form.appointmentId" @change="$dispatch('set-medical-data')">
                    <option value="">Selecciona la cita de esta consulta</option>
                    @foreach($appointments as $appointment)
                        <option value="{{$appointment->id}}">
                            Cita del {{$appointment->date->format('d/m/Y')}} a las {{$appointment->time->format('H:s')}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="date" class="uppercase">Fecha</label>
                <input wire:model='form.date' type="date" id="date" class="text-sm rounded border-zinc-400 disabled:bg-gray-200" disabled>
                @error('form.date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="time" class="uppercase">Hora</label>
                <input wire:model='form.time' type="time" id="time" class="text-sm rounded border-zinc-400 disabled:bg-gray-200" disabled>
                @error('form.time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="consultationType" class="uppercase">Tipo de consulta</label>
                <select wire:model='form.type_of_consultation' id="consultationType" class="text-sm rounded border-zinc-400 disabled:bg-gray-200" disabled>
                    <option value="">Selecciona una opción</option>
                    <option value="chronic">Crónicos</option>
                    <option value="healthy">Sanos</option>
                    <option value="planning">Planificación</option>
                    <option value="sexually_transmitted_diseases">Enf. transmisibles</option>
                    <option value="other_diseases">Otras enfermedades</option>
                    <option value="pregnancy_control">Control de embarazo</option>
                    <option value="nutritional_control">Control nutricional</option>
                </select>
                @error('form.type_of_consultation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="medicalChart" class="uppercase">Presenta cartilla</label>
                <select wire:model='form.medical_card' id="medicalChart" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="yes">Si</option>
                    <option value="no">No</option>
                </select>
                @error('form.medical_card')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="respiratorySymptom" class="uppercase">Sint. Respiratorio TB</label>
                <select wire:model='form.respiratory_symptoms' id="respiratorySymptom" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="yes">Si</option>
                    <option value="no">No</option>
                </select>
                @error('form.respiratory_symptoms')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="nutritionalStatus" class="uppercase">Estado nutricional</label>
                <select wire:model='form.nutritional_status' id="nutritionalStatus" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="underweight">Bajo Peso (Por debajo de 18,5)</option>
                    <option value="normal_weight">Peso normal (18,5,-24,9)</option>
                    <option value="overweight">Pre-obesidad o Sobrepeso (25.0-29.9)</option>
                    <option value="obesity_one">Obesidad clase I (30.0-34.9)</option>
                    <option value="obesity_two">Obesidad clase II (35,0-39,9)</option>
                    <option value="obesity_three">Obesidad clase III (Por encima de 40)</option>
                </select>
                @error('form.nutritional_status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <fieldset>
            <legend class="text-[#174075] text-xl mb-3">Padecimiento Actual (Motivo de consulta)</legend>

            <div class="flex flex-col">
                <textarea wire:model='form.reason_for_consultation' id="currentCondition" class="rounded border-zinc-400" rows="4"></textarea>
                @error('form.reason_for_consultation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <x-vital-signs-consultation />

        <fieldset class="my-4">
            <legend class="text-[#174075] text-xl mb-4">Exploración Física</legend>
            <div class="flex flex-col">
                <textarea wire:model='form.physical_examination' id="physicalExamination" class="rounded border-zinc-400"></textarea>
                @error('form.physical_examination')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <section class="grid grid-cols-2 gap-4">
            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Plan de manejo</legend>
                <div class="flex flex-col">
                    <textarea wire:model='form.management_plan' id="managementPlan" class="rounded border-zinc-400"></textarea>
                    @error('form.management_plan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>

            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Análisis</legend>
                <div class="flex flex-col">
                    <textarea wire:model='form.analysis' id="analysis"  class="rounded border-zinc-400"></textarea>
                    @error('form.analysis')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>
        </section>

        @livewire('diagnosis-of-diseases')
        @livewire('medical-procedures')

        <section class="grid grid-cols-2 gap-4 mt-10">
            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Impresión diagnóstica</legend>
                <div class="flex flex-col">
                    <textarea wire:model='form.diagnostic_impression' id="diagnosticImpression" class="rounded border-zinc-400"></textarea>
                    @error('form.diagnostic_impression')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>

            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Pronóstico</legend>
                <div class="flex flex-col">
                    <textarea wire:model='form.prognosis' id="forecast" class="rounded border-zinc-400"></textarea>
                    @error('form.prognosis')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>
        </section>

        <div class="flex items-center justify-end mt-8">
            <div class="flex gap-3">
                <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Finalizar consulta
                </button>

                {{-- <button wire:click.prevent='finish'  class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Finalizar consulta
                </button> --}}
            </div>
        </div>
    </form>
</div>

@script
<script>
    document.addEventListener('livewire:initialized', function () {
        let heightInput = document.getElementById('height');
        let weightInput = document.getElementById('weight');
        let imc = document.getElementById('imc');

        heightInput.addEventListener('input', heightFormat);
        weightInput.addEventListener('input', weightFormat);
        heightInput.addEventListener('blur', calculateIMC);
        weightInput.addEventListener('blur', calculateIMC);

        function weightFormat(e) {

            let input = e.target;
            let value = input.value;

            // Remove any non-numeric characters
            let numericValue = value.replace(/\D/g, '');

            // Limit the numeric value to 3 digits
            numericValue = numericValue.slice(0, 3);

            // Update the input value
            input.value = numericValue;
        }

        function heightFormat(e) {

            let input = e.target;
            let value = input.value;

            // Remove any non-numeric characters except the decimal point
            let cleanedValue = value.replace(/[^0-9.]/g, '');

            // Ensure only one decimal point is allowed
            let decimalParts = cleanedValue.split('.');
            if (decimalParts.length > 2) {
                // If more than one decimal point, keep only the first one
                cleanedValue = decimalParts[0] + '.' + decimalParts.slice(1).join('');
            }

            // Limit the integer part to 1 digit and the decimal part to 2 digits
            if (decimalParts.length > 1) {
                cleanedValue = decimalParts[0].slice(0, 1) + '.' + decimalParts[1].slice(0, 2);
            } else {
                cleanedValue = decimalParts[0].slice(0, 1);
            }

            // Update the input value
            input.value = cleanedValue;
        }


        function calculateIMC() {

            let height = parseFloat(heightInput.value);
            let weight = parseFloat(weightInput.value);

            if(isNaN(weight) || weight <= 0 || isNaN(height) || height <= 0) {
                return;
            }

            //Calculate BMI
            let bmi = (weight / (height * height)).toFixed(2);

            //Display the result
            $wire.form.imc = bmi;
        }
    });
</script>
@endscript
