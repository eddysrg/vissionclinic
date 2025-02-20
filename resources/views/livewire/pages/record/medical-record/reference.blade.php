<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title, Computed, On};
use App\Livewire\Forms\ReferenceForm;
use Carbon\Carbon;
use App\Models\{Patient, HealthUnit, Consultation, Record};


new 
#[Layout('layouts.record')] 
#[Title('Referencia - Vission Clinic ECE')]
class extends Component {

    public ReferenceForm $form;

    public $search = '';
    public $results = [];
    public $patient;
    public $id;

    public function save()
    {
        $this->form->store();
        $this->dispatch('show-notification', message: 'Referencia médica registrada con éxito');

    }

    public function updatedSearch()
    {
        $this->results = HealthUnit::where('clues', 'like', '%' . $this->search . '%')
        ->select('clues')
        ->take(5)
        ->get();
    }

    public function setUnitData($value = null)
    {
        $this->search = '';

        if(is_null($value)) return;

        $searchForClues = HealthUnit::where('clues', $value)->first();

        if($searchForClues) {
            $this->form->clues = $searchForClues->clues;
            $this->form->entity = $searchForClues->state;
            $this->form->health_institution = $searchForClues->institution_name;
            $this->form->destination_unit = $searchForClues->unit_name;

            $address = $searchForClues->road_name . ' ' . $searchForClues->exterior_number . ' ' . $searchForClues->settlement_type . ' ' . $searchForClues->settlement . ' ' . 'C.P' . ' ' . $searchForClues->postal_code;

            $this->form->address = $address;
        } else {
            $this->form->clues = '';
        }
    }

    public function printReference()
    {
        $validated = $this->validate();

        $pdf = Pdf::loadView('pdf.referencePrint', $validated);

        return response()->streamDownload(
            fn () => print($pdf->output()), 'referencia-medica.pdf'
        );
    }


    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $this->patient);

        $this->id = $id;

        //Set medical record section
        $referenceSectionInfo = Patient::with(['record.medicalRecordSections' => function ($query) {
            $query->where('name', 'reference');
        }])->findOrFail($this->patient->id)->record->medicalRecordSections->first();
        
        //Set medical record section ID
        $this->form->medicalRecordSectionId = $referenceSectionInfo->id;

        //Set current date and time
        $this->form->date = Carbon::now()->format('Y-m-d');
        $this->form->time = Carbon::now()->format('H:i');

        // Vital signs from medical consultation
        $medicalConsultation = Record::with(['medicalRecordSections' => function ($query) {
            $query->where('name', 'medical_consultation');
        },
        'medicalRecordSections.medicalConsultation'
        ])->find($referenceSectionInfo->record_id)?->medicalRecordSections->first()?->medicalConsultation->first();

        if($medicalConsultation) {
            $this->form->thereIsConsultation = true;
            $this->form->weight = $medicalConsultation->weight;
            $this->form->height = $medicalConsultation->height;
            $this->form->imc = $medicalConsultation->imc;
            $this->form->icc = $medicalConsultation->icc;
            $this->form->heartRate = $medicalConsultation->heart_rate;
            $this->form->respiratoryRate = $medicalConsultation->respiratory_rate;
            $this->form->temperature = $medicalConsultation->temperature;
            $this->form->glycemia = $medicalConsultation->glycemia;
            $this->form->bloodPressure = $medicalConsultation->blood_pressure;
            $this->form->oxygenSaturation = $medicalConsultation->oxygen_saturation;
        }
    }
}; ?>

<div>
    <x-slot:id>
        {{$id}}
    </x-slot>

    <x-notification/>

    <h2 class="text-3xl text-[#174075]">Referencia</h2>

    <form wire:submit='save' class="mt-5">
        <fieldset class="grid grid-cols-3 gap-6">
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
                <label class="text-xs" for="isUrgent" class="uppercase">Urgente</label>
                <select wire:model='form.isUrgent' type="text" id="isUrgent" class="text-sm rounded border-zinc-400">
                    <option value="">Seleccione una opción</option>
                    <option value="si">Si</option>
                    <option value="no">No</option>
                </select>
                @error('form.isUrgent') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col relative">
                <label class="text-xs" for="clue" class="uppercase">Clues de envío</label>
                <input type="text" wire:model.live='search' @blur="$wire.setUnitData($wire.search)" id="clue" class="text-sm rounded border-zinc-400" placeholder="Busque CLUES por su código">

                @if ($search)
                    <div class="bg-white border border-black absolute p-3 rounded-md w-full top-14">
                        @forelse ($results as $clues)
                            <p class="py-1 text-sm cursor-pointer" wire:click='setUnitData("{{$clues->clues}}")'>{{$clues->clues}}</button>
                        @empty
                            <p class="py-1 text-sm">No hay registro de este clues</p>
                        @endforelse
                    </div>
                @endif
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="clues" class="uppercase">Clues seleccionado</label>
                <input type="text" wire:model.live='form.clues' id="clues" class="text-sm rounded border-zinc-400 disabled:bg-gray-100" disabled>
                @error('form.clues') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="reference_unit" class="uppercase">Unidad que refiere</label>
                <select wire:model='form.reference_unit' id="reference_unit" class="text-sm rounded border-zinc-400">
                    <option value="">Seleccione una opción</option>
                    <option value="medicina_general">Medicina General</option>
                    <option value="pediatria">Pediatría</option>
                    <option value="ginecologia_obstetricia">Ginecología y Obstetricia</option>
                    <option value="cardiologia">Cardiología</option>
                    <option value="dermatologia">Dermatología</option>
                    <option value="neurologia">Neurología</option>
                    <option value="oftalmologia">Oftalmología</option>
                    <option value="otorrinolaringologia">Otorrinolaringología</option>
                    <option value="psiquiatria">Psiquiatría</option>
                    <option value="traumatologia_ortopedia">Traumatología y Ortopedia</option>
                    <option value="urologia">Urología</option>
                    <option value="endocrinologia">Endocrinología</option>
                    <option value="gastroenterologia">Gastroenterología</option>
                    <option value="neumologia">Neumología</option>
                    <option value="reumatologia">Reumatología</option>
                    <option value="oncologia">Oncología</option>
                </select>

                @error('form.reference_unit') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="reference_by" class="uppercase">Referencia por</label>
                <select wire:model='form.reference_by' id="reference_by" class="text-sm rounded border-zinc-400">
                    <option value="">Seleccione una opción</option>
                    <option value="diagnostico_especializado">Diagnóstico Especializado</option>
                    <option value="tratamiento_especifico">Tratamiento específico</option>
                    <option value="segunda_opinion">Segunda Opinión</option>
                    <option value="procedimientos_quirurgicos">Procedimientos Quirúrgicos</option>
                    <option value="rehabilitacion">Rehabilitación</option>
                    <option value="atencion_de_urgencia">Atención de Urgencia</option>
                    <option value="servicios_de_salud_mental">Servicios de salud mental</option>
                    <option value="atencion_materno_infantil">Atención Materno-infantil</option>
                </select>
                @error('form.reference_by') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <fieldset class="mt-10">
            <legend class="text-[#174075] text-xl mb-4">Unidad a la que se refiere</legend>

            <section class="grid grid-cols-6 gap-4">
                <div class="flex flex-col col-span-3">
                    <label class="text-xs" for="entity" class="uppercase">Entidad</label>
                    <input type="text" wire:model='form.entity' id="entity" class="text-sm rounded border-zinc-400 disabled:bg-gray-100" disabled>
                    @error('form.entity') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col col-span-3">
                    <label class="text-xs" for="health_institution" class="uppercase">Institución de salud</label>
                    <input type="text" wire:model='form.health_institution' id="health_institution" class="text-sm rounded border-zinc-400 disabled:bg-gray-100" disabled>
                    @error('form.health_institution') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col col-span-3">
                    <label class="text-xs" for="destination_unit" class="uppercase">Unidad destino</label>
                    <input type="text" wire:model='form.destination_unit' id="destination_unit" class="text-sm rounded border-zinc-400 disabled:bg-gray-100" disabled>
                    @error('form.destination_unit') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col col-span-3">
                    <label class="text-xs" for="address" class="uppercase">Domicilio</label>
                    <input type="text" wire:model='form.address' id="address" class="text-sm rounded border-zinc-400 disabled:bg-gray-100" disabled autocomplete="address-level1">
                    @error('form.address') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col col-span-2">
                    <label class="text-xs" for="service" class="uppercase">Servicio</label>
                    <input type="text" wire:model='form.service' id="service" class="text-sm rounded border-zinc-400">
                    @error('form.service') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </section>
        </fieldset>

        <fieldset class="mt-10">
            <section class="flex items-center gap-4">
                <legend class="text-[#174075] text-xl">Datos clínicos</legend>
                <div class="flex items-center gap-1">
                    <label for="patient_on_fast" class="text-sm">Paciente en ayuno</label>
                    <input type="checkbox" wire:model='form.patient_on_fast' id="patient_on_fast" class="bg-gray-300 border-none rounded-full">
                    @error('form.patient_on_fast') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                </div>
            </section>

            @if (!$form->thereIsConsultation)
            <section class="flex justify-end">
                <p>LLene los signos vitales en la sección de <a href="{{route('dashboard.record.medical-consultation', ['id' => $patient->id])}}" class="text-blue-500 border-b border-blue-500">consulta médica</a></p>
            </section>
            @endif

            <section class="mt-8 grid grid-cols-2 gap-8">
                <div class="flex flex-col">
                    <div class="flex flex-col flex-1">
                        <label class="text-xs" for="reason_for_reference" class="uppercase">Motivo de la referencia</label>
                        <textarea wire:model='form.reason_for_reference' id="reason_for_reference" class="text-sm rounded border-zinc-400 h-full"></textarea>
                        @error('form.reason_for_reference') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="flex flex-col mt-8 flex-1">
                        <label class="text-xs" for="diagnostic_impression" class="uppercase">Impresión diagnóstica</label>
                        <textarea wire:model='form.diagnostic_impression' id="diagnostic_impression" class="text-sm rounded border-zinc-400 h-full"></textarea>
                        @error('form.diagnostic_impression') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="weight" class="uppercase text-xs">Peso</label>
                        <div class="relative">
                            <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" wire:model='form.weight' type="text" id="weight" placeholder="Ej: 70" disabled>
                            <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">Kg</span>
                        </div>
                        @error('form.weight') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div>
                        <label for="height" class="uppercase text-xs">Talla</label>
                        <div class="relative">
                            <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" wire:model='form.height' type="text" id="height" placeholder="Ej: 1.80" disabled>
                            <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">m</span>
                        </div>
                        @error('form.height') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div>
                        <label for="imc" class="uppercase text-xs">IMC</label>
                        <div class="relative">
                            <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" disabled wire:model='form.imc' type="text" id="imc" placeholder="Ingrese peso y talla">
                            <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">kg/m²</span>
                        </div>
                        @error('form.imc') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div>
                        <label for="icc" class="uppercase text-xs">ICC</label>
                        <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" wire:model='form.icc' type="text" id="icc" disabled>
                        @error('form.icc') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div>
                        <label for="heartRate" class="uppercase text-xs">Frec. Cardíaca</label>
                        <div class="relative">
                            <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" wire:model='form.heartRate' type="text" id="heartRate" disabled>
                            <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">lpm</span>
                        </div>
                        @error('form.heartRate') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div>
                        <label for="respiratoryRate" class="uppercase text-xs">Frec. Respiratoria</label>
                        <div class="relative">
                            <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" wire:model='form.respiratoryRate' type="text" id="respiratoryRate" disabled>
                            <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">rpm</span>
            
                        </div>
                        @error('form.respiratoryRate') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div>
                        <label for="temperature" class="uppercase text-xs">Temperatura</label>
                        <div class="relative">
                            <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" wire:model='form.temperature' type="text" id="temperature" disabled>
                            <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">°C</span>
            
                        </div>
                        @error('form.temperature') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div>
                        <label for="glycemia" class="uppercase text-xs">Glucemia</label>
                        <div class="relative">
                            <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" wire:model='form.glycemia' type="text" id="glycemia" disabled>
                            <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">mg/dL</span>
            
                        </div>
                        @error('form.glycemia') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div>
                        <label for="bloodPressure" class="uppercase text-xs">Tensión Arterial</label>
                        <div class="relative">
                            <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" wire:model='form.bloodPressure' type="text" id="bloodPressure" disabled>
                            <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">mmHg</span>
            
                        </div>
                        @error('form.bloodPressure') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div>
                        <label for="oxygenSaturation" class="uppercase text-xs">Saturación de oxígeno</label>
                        <div class="relative">
                            <input class="text-sm rounded border-zinc-400 w-full disabled:bg-gray-100" wire:model='form.oxygenSaturation' type="text" id="oxygenSaturation" disabled>
                            <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">%</span>
            
                        </div>
                        @error('form.oxygenSaturation') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </section>
        </fieldset>

        <fieldset class="mt-8">
            <legend class="text-[#174075] text-xl ">Unidad a la que se refiere</legend>

            <section class="grid grid-cols-2">
                <div class="flex flex-col mt-5">
                    <label class="text-xs" for="physicalFolio" class="uppercase">Folio físico</label>
                    <input wire:model='form.physicalFolio' type="text" id="physicalFolio" class="text-sm rounded border-zinc-400">
                    @error('form.physicalFolio') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </section>
        </fieldset>

        

        <div class="flex items-center justify-end mt-8">
            <div class="flex gap-3">
                <button wire:click.prevent='printReference' class="px-8 py-1 bg-[#41759D] text-white rounded-full flex items-center gap-2">
                    Imprimir
                </button>
                
                <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Guardar
                </button>
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