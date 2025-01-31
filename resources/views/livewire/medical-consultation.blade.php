<?php

use Livewire\Volt\Component;
use Carbon\Carbon;
use App\Livewire\Forms\MedicalConsultationForm;

new class extends Component {

    protected $listeners = ['setDiagnosisOfDiseases', 'removeDisease'];
   
    public MedicalConsultationForm $form;

    public function save()
    {

        if(empty($this->form->diseases)) {
            $this->dispatch('diagnosis-alert', message: "Debes seleccionar un diagnóstico de enfermedad del catálogo");
            return;
        }
        
        $this->form->store();

    }

    public function setDiagnosisOfDiseases($diagnosisOfDiseases)
    {
        $this->form->diseases = $diagnosisOfDiseases;
    }

    public function removeDisease($id)
    {
        $this->form->diseases = collect($this->form->diseases)->reject(fn($item) => $item['id'] === $id)->toArray();
    }

    public function mount()
    {
        $this->form->setMedicalData();
    }
}; ?>

<div x-on:diagnosis-alert.window="alert($event.detail.message)" x-on:diagnosis-failed.window="alert($event.detail.message)">

    <form wire:submit='save'>
        <fieldset class="grid grid-cols-3 gap-5 my-8">
            <div class="flex flex-col">
                <label class="text-xs" for="date" class="uppercase">Fecha</label>
                <input wire:model='form.date' type="date" id="date" class="text-sm rounded border-zinc-400">
                @error('form.date') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="time" class="uppercase">Hora</label>
                <input wire:model='form.time' type="time" id="time" class="text-sm rounded border-zinc-400">
                @error('form.time') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="consultationType" class="uppercase">Tipo de consulta</label>
                <select wire:model='form.consultationType' id="consultationType" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="chronic">Crónicos</option>
                    <option value="healthy">Sanos</option>
                    <option value="planning">Planificación</option>
                    <option value="sexually_transmitted_diseases">Enf. transmisibles</option>
                    <option value="other_diseases">Otras enfermedades</option>
                </select>
                @error('form.consultationType') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="medicalChart" class="uppercase">Presenta cartilla</label>
                <select wire:model='form.medicalChart' id="medicalChart" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="yes">Si</option>
                    <option value="no">No</option>
                </select>
                @error('form.medicalChart') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="respiratorySymptom" class="uppercase">Sint. Respiratorio TB</label>
                <select wire:model='form.respiratorySymptom' id="respiratorySymptom" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="yes">Si</option>
                    <option value="no">No</option>
                </select>
                @error('form.respiratorySymptom') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="nutritionalStatus" class="uppercase">Estado nutricional</label>
                <select wire:model='form.nutritionalStatus' id="nutritionalStatus" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="underweight">Bajo Peso (Por debajo de 18,5)</option>
                    <option value="normal_weight">Peso normal (18,5,-24,9)</option>
                    <option value="overweight">Pre-obesidad o Sobrepeso (25.0-29.9)</option>
                    <option value="obesity_one">Obesidad clase I (30.0-34.9)</option>
                    <option value="obesity_two">Obesidad clase II (35,0-39,9)</option>
                    <option value="obesity_three">Obesidad clase III (Por encima de 40)</option>
                </select>
                @error('form.nutritionalStatus') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <fieldset>
            <legend class="text-[#174075] text-xl mb-3">Padecimiento Actual (Motivo de consulta)</legend>

            <div class="flex flex-col">
                <textarea wire:model='form.currentCondition' id="currentCondition" class="rounded border-zinc-400" rows="4"></textarea>
                @error('form.currentCondition') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <x-vital-signs />

        <fieldset class="my-4">
            <legend class="text-[#174075] text-xl mb-4">Exploración Física</legend>
            <div class="flex flex-col">
                <textarea wire:model='form.physicalExamination' id="physicalExamination" class="rounded border-zinc-400"></textarea>
                @error('form.physicalExamination') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <section class="grid grid-cols-2 gap-4">
            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Plan de manejo</legend>
                <div class="flex flex-col">
                    <textarea wire:model='form.managementPlan' id="managementPlan" class="rounded border-zinc-400"></textarea>
                    @error('form.managementPlan') 
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

        <section class="grid grid-cols-2 gap-4 mt-10">
            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Impresión diagnóstica</legend>
                <div class="flex flex-col">
                    <textarea wire:model='form.diagnosticImpression' id="diagnosticImpression" class="rounded border-zinc-400"></textarea>
                    @error('form.diagnosticImpression') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>
    
            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Pronóstico</legend>
                <div class="flex flex-col">
                    <textarea wire:model='form.forecast' id="forecast" class="rounded border-zinc-400"></textarea>
                    @error('form.forecast') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>
        </section>

        <div class="flex items-center justify-end mt-8">
            <div class="flex gap-3">
                <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Guardar
                </button>

                <button wire:click.prevent='finish'  class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Finalizar consulta
                </button>
            </div>
        </div>

    </form>
</div>

@script
<script>
    $wire.on('saved', (event) => {
        console.log(event);
    });

    document.addEventListener('livewire:initialized', function () {
        const heightInput = document.getElementById('height');
        const weightInput = document.getElementById('weight');

        let heightWeight = [heightInput, weightInput];

        calculateIMC();

        heightInput.addEventListener('input', (e) => {
            const value = e.target.value;

            if(!/^\d+(\.\d{0,2})?$/.test(value)) {
                e.target.value = value.slice(0, -1);
            }
        });

        heightWeight.forEach(element => {
            element.addEventListener('change', (e) => {
                calculateIMC();
            });
        });

        function calculateIMC(elements) {
            if(heightInput.value && weightInput.value) {
                const imc = weightInput.value / Math.pow(heightInput.value, 2);
                $wire.imc = imc.toFixed(2);
            }

            return;
        }
    });
</script>
@endscript