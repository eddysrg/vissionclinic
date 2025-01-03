<?php

use Livewire\Volt\Component;

new class extends Component {
    public $date;
    public $time;
    public $consultationType;
    public $medicalChart;
    public $respiratorySymptom;
    public $nutritionalStatus;
    public $currentCondition;
    public $patientFasting = false;
    public $weight;
    public $height;
    public $imc;
    public $icc;
    public $heartRate;
    public $respiratoryRate;
    public $temperature;
    public $glycemia;
    public $bloodPressure;
    public $oxygenSaturation;
    public $physicalExamination;
    public $managementPlan;
    public $analysis;
    public $diagnosticImpression;
    public $forecast;

    public function save()
    {
        $validated = $this->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'consultationType' => 'required|in:chronic,healthy,planning,sexually_transmitted_diseases,other_diseases',
            'medicalChart' => 'required|in:yes,no',
            'respiratorySymptom' => 'required|in:yes,no',
            'nutritionalStatus' => 'required|in:underweight,normal_weight,overweight,obesity_one,obesity_two,obesity_three',
            'currentCondition' => 'required|string',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'imc' => 'required|numeric',
            'icc' => 'required|string',
            'heartRate' => 'required|string',
            'respiratoryRate' => 'required|string',
            'temperature' => 'required|string',
            'glycemia' => 'required|string',
            'bloodPressure' => 'required|string',
            'oxygenSaturation' => 'required|string',
            'physicalExamination' => 'required|string',
            'managementPlan' => 'required|string',
            'analysis' => 'required|string',
            'diagnosticImpression' => 'required|string',
            'forecast' => 'required|string',
        ]);

        dd($validated);


        // $this->dispatch('saved', data: $validated);
    }

    public function mount()
    {
        // $this->date = '2024-12-27';
        // $this->time = '12:00';
        // $this->consultationType = 'chronic';
        // $this->medicalChart = 'yes';
        // $this->respiratorySymptom = 'yes';
        // $this->nutritionalStatus = 'underweight';
        // $this->currentCondition = 'Tiene fiebre';
        // $this->patientFasting = true;
        // $this->weight = '70';
        // $this->height = '1.66';
        // $this->icc = '20';
        // $this->heartRate = '20';
        // $this->respiratoryRate = '20';
        // $this->temperature = '20';
        // $this->glycemia = '20';
        // $this->bloodPressure = '20';
        // $this->oxygenSaturation = '20';
        // $this->physicalExamination = 'Quiubolas';
        // $this->managementPlan = 'Que tranza';
        // $this->analysis = 'Hola raza';
        // $this->diagnosticImpression = 'Hola mi amor';
        // $this->forecast = 'Sexo';

    }
}; ?>

<div>



    <form wire:submit='save'>
        <fieldset class="grid grid-cols-3 gap-5 my-8">
            <div class="flex flex-col">
                <label class="text-xs" for="date" class="uppercase">Fecha</label>
                <input wire:model='date' type="date" id="date" class="text-sm rounded border-zinc-400">
                @error('date') 
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="time" class="uppercase">Hora</label>
                <input wire:model='time' type="time" id="time" class="text-sm rounded border-zinc-400">
                @error('time') 
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="consultationType" class="uppercase">Tipo de consulta</label>
                <select wire:model='consultationType' id="consultationType" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="chronic">Crónicos</option>
                    <option value="healthy">Sanos</option>
                    <option value="planning">Planificación</option>
                    <option value="sexually_transmitted_diseases">Enf. transmisibles</option>
                    <option value="other_diseases">Otras enfermedades</option>
                </select>
                @error('consultationType') 
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="medicalChart" class="uppercase">Presenta cartilla</label>
                <select wire:model='medicalChart' id="medicalChart" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="yes">Si</option>
                    <option value="no">No</option>
                </select>
                @error('medicalChart') 
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="respiratorySymptom" class="uppercase">Sint. Respiratorio TB</label>
                <select wire:model='respiratorySymptom' id="respiratorySymptom" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="yes">Si</option>
                    <option value="no">No</option>
                </select>
                @error('respiratorySymptom') 
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="nutritionalStatus" class="uppercase">Estado nutricional</label>
                <select wire:model='nutritionalStatus' id="nutritionalStatus" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="underweight">Bajo Peso (Por debajo de 18,5)</option>
                    <option value="normal_weight">Peso normal (18,5,-24,9)</option>
                    <option value="overweight">Pre-obesidad o Sobrepeso (25.0-29.9)</option>
                    <option value="obesity_one">Obesidad clase I (30.0-34.9)</option>
                    <option value="obesity_two">Obesidad clase II (35,0-39,9)</option>
                    <option value="obesity_three">Obesidad clase III (Por encima de 40)</option>
                </select>
                @error('nutritionalStatus') 
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <fieldset>
            <legend class="text-[#174075] text-xl mb-3">Padecimiento Actual (Motivo de consulta)</legend>

            <div class="flex flex-col">
                <textarea wire:model='currentCondition' id="currentCondition" class="rounded border-zinc-400" rows="4"></textarea>
                @error('currentCondition') 
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <x-vital-signs />

        <fieldset class="my-4">
            <legend class="text-[#174075] text-xl mb-4">Exploración Física</legend>
            <div class="flex flex-col">
                <textarea wire:model='physicalExamination' id="physicalExamination" class="rounded border-zinc-400"></textarea>
                @error('physicalExamination') 
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <section class="grid grid-cols-2 gap-4">
            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Plan de manejo</legend>
                <div class="flex flex-col">
                    <textarea wire:model='managementPlan' id="managementPlan" class="rounded border-zinc-400"></textarea>
                    @error('managementPlan') 
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>

            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Análisis</legend>
                <div class="flex flex-col">
                    <textarea wire:model='analysis' id="analysis"  class="rounded border-zinc-400"></textarea>
                    @error('analysis') 
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>
        </section>



        @livewire('diagnosis-of-diseases')

        <section class="grid grid-cols-2 gap-4 mt-10">
            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Impresión diagnóstica</legend>
                <div class="flex flex-col">
                    <textarea wire:model='diagnosticImpression' id="diagnosticImpression" class="rounded border-zinc-400"></textarea>
                    @error('diagnosticImpression') 
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>
    
            <fieldset>
                <legend class="text-[#174075] text-xl mb-4">Pronóstico</legend>
                <div class="flex flex-col">
                    <textarea wire:model='forecast' id="forecast" class="rounded border-zinc-400"></textarea>
                    @error('forecast') 
                        <span class="text-red-500">{{ $message }}</span>
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