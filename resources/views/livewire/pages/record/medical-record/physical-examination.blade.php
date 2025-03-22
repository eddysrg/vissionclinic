<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\{Patient, PhysicalExamination, MedicalRecord};
use App\Livewire\Forms\PhysicalExaminationForm;
use Illuminate\View\View;


new
#[Layout('components.layout.record')]
#[Title('Exploración Física - Vission Clinic ECE')]
class extends Component {

    public PhysicalExaminationForm $form;
    public $patient;
    public $apparatusBodySystems = [
        'Aparato Respiratorio', 'Aparato Digestivo', 'Aparato Cardiovascular',
        'Aparato Genitourinario', 'Sistema Nervioso', 'Sistema Musculoesquelético',
    ];
    public $physicalExaminationInputs = [
        'Cráneo', 'Cara', 'Ojos', 'Nariz', 'Boca', 'Cuello', 'Tórax', 'Abdomen', 'Extremidades'
    ];

    public function save()
    {
        $this->form->store();
        $route = route('dashboard.record.physical-examination', ['id' => $this->patient->id]);
        $this->dispatch('show-noti', message: 'Exploración física guardada correctamente', link: $route);
    }

    public function previous()
    {
        $this->form->store();
        $route = route('dashboard.record.non-pathological-history', ['id' => $this->patient->id]);
        $this->dispatch('show-noti', message: 'Datos guardados correctamente', link: $route);
    }

    public function cleanText(string $text)
    {
        $text = mb_strtolower($text, 'UTF-8');
        $acentos = [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'ä' => 'a', 'ë' => 'e', 'ï' => 'i', 'ö' => 'o', 'ü' => 'u',
            'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
            'Ä' => 'a', 'Ë' => 'e', 'Ï' => 'i', 'Ö' => 'o', 'Ü' => 'u',
            'ñ' => 'n', 'Ñ' => 'n'
        ];
        $text = strtr($text, $acentos);
        $text = str_replace(' ', '_', $text);
        return $text;
    }

    public function validateFullMedicalRecord() {
        $medicalRecord = MedicalRecord::find($this->form->medicalRecordId);

        $missingRecords = [];

        if(empty($medicalRecord->identificationForm)) {
            $missingRecords[] = 'Ficha de Identificación';
        }

        if($medicalRecord->familyHistory->isEmpty()) {
            $missingRecords[] = 'Antecedentes Heredofamiliares';
        }

        if(!$medicalRecord->pathologicalHistory) {
            $missingRecords[] = 'Antecedentes Patológicos';
        }

        if(!$medicalRecord->nonPathologicalHistory) {
            $missingRecords[] = 'Antecedentes No Patológicos';
        }

        if(!$medicalRecord->physicalExamination) {
            $missingRecords[] = 'Exploración Física';
        }

        if(!empty($missingRecords)) {
            $this->dispatch('section-modal', sections: $missingRecords);
        } else {
            dd('Estan todos completos');
        }
    }

    public function print() {
        $this->validateFullMedicalRecord();
    }

    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
        $this->form->medicalRecordId = $this->patient->load('record.medicalRecord')->record->medicalRecord->id;
        $this->form->setData();
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

<div>
    <x-slot:patientID>
        {{$this->patient->id}}
    </x-slot:patientID>

    <x-record-notification/>

    <x-sections-modal/>

    <h2 class="text-3xl text-[#174075]">Exploración Física</h2>

    @if($errors->any())
        <div class="mt-5 bg-red-200 border border-red-500 text-center text-red-500">
            Debe llenar todos los campos de este formulario
        </div>

        <div class="bg-red-200 mt-1 border border-red-500">
            <ul class="text-red-500 text-center">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit='save'>
        <section class="flex gap-10 my-5">
            <div class="flex flex-col gap-2">
                <span class="md:text-xs 2xl:text-sm">Fecha</span>
                <p class="text-blue-500 font-bold border border-blue-500 rounded p-2">{{now()->format('d/m/Y')}}</p>
            </div>

            <div class="flex flex-col gap-2">
                <span class="md:text-xs 2xl:text-sm">Fecha</span>
                <p class="text-blue-500 font-bold border border-blue-500 rounded p-2">{{now()->format('H:i:s')}}</p>
            </div>
        </section>

        <x-vital-signs-examination/>

        <section>
            <h3 class="text-2xl text-[#174075] my-5">Habitus exterior</h3>
            <div class="w-full">
                <textarea wire:model='form.habitus_exterior' class="w-full rounded border-zinc-300" id="external_habitus"
                          rows="6"></textarea>
            </div>
        </section>

        <section class="flex flex-col gap-6">
            <h3 class="text-2xl text-[#174075] my-3">Interrogatorio por aparatos y sistemas</h3>

            <section class="space-y-5">
                @foreach($apparatusBodySystems as $system)
                    <div class="flex items-center gap-5">
                        <div class="flex flex-col gap-2 w-full">
                            <label for="{{$this->cleanText($system)}}"
                                   class="uppercase md:text-xs 2xl:text-sm">{{$system}}</label>
                            <input type="text" class="w-full py-1 rounded border-zinc-300"
                                   id="{{$this->cleanText($system)}}" wire:model="form.{{$this->cleanText($system)}}">
                        </div>

                        <div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <label for="{{$this->cleanText($system)}}__anormal" class="md:text-xs 2xl:text-sm">Anormal</label>
                                    <input type="radio" class="bg-gray-300 border-none"
                                           id="{{$this->cleanText($system)}}__anormal" value="Anormal"
                                           wire:model="form.{{$this->cleanText($system)}}_status">
                                </div>

                                <div class="flex items-center gap-2">
                                    <label for="{{$this->cleanText($system)}}__normal" class="md:text-xs 2xl:text-sm">Normal</label>
                                    <input type="radio" class="bg-gray-300 border-none"
                                           id="{{$this->cleanText($system)}}__normal" value="Normal"
                                           wire:model="form.{{$this->cleanText($system)}}_status">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        </section>

        <section class="flex flex-col gap-5">
            <h3 class="text-2xl text-[#174075] my-3">Exploración física</h3>

            <section class="space-y-5">
                @foreach ($physicalExaminationInputs as $input)
                    <div class="flex items-center gap-5">
                        <div class="flex flex-col gap-2 w-full">
                            <label for="{{$this->cleanText($input)}}" class="uppercase md:text-xs 2xl:text-sm">{{$input}}</label>
                            <input type="text" class="w-full py-1 rounded border-zinc-300" id="{{$this->cleanText($input)}}" wire:model="form.{{$this->cleanText($input)}}">
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <label for="{{$this->cleanText($input)}}__anormal" class="md:text-xs 2xl:text-sm">Anormal</label>
                                <input type="radio" class="bg-gray-300 border-none" id="{{$this->cleanText($input)}}__anormal" value="Anormal" wire:model="form.{{$this->cleanText($input)}}_status">
                            </div>

                            <div class="flex items-center gap-2">
                                <label for="{{$this->cleanText($input)}}__normal" class="md:text-xs 2xl:text-sm">Normal</label>
                                <input type="radio" class="bg-gray-300 border-none" id="{{$this->cleanText($input)}}__normal" value="Normal" wire:model="form.{{$this->cleanText($input)}}_status">
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        </section>

        <div class="flex items-center justify-end mt-8">
            <div class="flex gap-3">
                <button wire:click.prevent='previous'
                        class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Anterior
                </button>

                <button wire:click.prevent="print" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
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

        if(heightInput && weightInput) {
            heightInput.addEventListener('input', heightFormat);
            weightInput.addEventListener('input', weightFormat);
            heightInput.addEventListener('blur', calculateIMC);
            weightInput.addEventListener('blur', calculateIMC);
        }

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
