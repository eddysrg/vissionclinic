<?php

use Livewire\Volt\Component;
use App\Models\Patient;
use App\Models\PhysicalExamination;
use Carbon\Carbon;

new class extends Component {
    public $patient;
    public $sectionId;

    public $date;
    public $time;
    public $weight;
    public $height;
    public $bmi;
    public $chf;
    public $heartRate;
    public $respiratoryRate;
    public $temperature;
    public $glycemia;
    public $bloodPressure;
    public $oxygenSaturation;
    public $externalHabitus;

    public $testSystems = [
        'respiratory' => [
            'name' => 'Aparato Respiratorio',
            'status' => '',
            'value' => ''
        ],
        'digestive' => [
            'name' => 'Aparato Digestivo',
            'status' => '',
            'value' => ''
        ],
        'cardiovascular' => [
            'name' => 'Aparato Cardiovascular',
            'status' => '',
            'value' => ''
        ],
        'genitourinary' => [
            'name' => 'Aparato Genitourinario',
            'status' => '',
            'value' => ''
        ],
        'nervous' => [
            'name' => 'Sistema Nervioso',
            'status' => '',
            'value' => ''
        ],
        'musculoskeletal' => [
            'name' => 'Sistema Musculoesquelético',
            'status' => '',
            'value' => ''
        ],
    ];

    public $testPhysical = [
        'skull' => [
            'name' => 'Cráneo',
            'status' => '',
            'value' => ''
        ],
        'face' => [
            'name' => 'Cara',
            'status' => '',
            'value' => ''
        ],
        'eyes' => [
            'name' => 'Ojos',
            'status' => '',
            'value' => ''
        ],
        'nose' => [
            'name' => 'Nariz',
            'status' => '',
            'value' => ''
        ],
        'mouth_pharynx' => [
            'name' => 'Boca y faringe',
            'status' => '',
            'value' => ''
        ],
        'neck' => [
            'name' => 'Cuello',
            'status' => '',
            'value' => ''
        ],
        'chest' => [
            'name' => 'Toráx',
            'status' => '',
            'value' => ''
        ],
        'abdomen' => [
            'name' => 'Abdomen',
            'status' => '',
            'value' => ''
        ],
        'limbs' => [
            'name' => 'Extremidades',
            'status' => '',
            'value' => ''
        ],
    ];
    

    public function save()
    {
        $validated = $this->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'weight' => 'required|string',
            'height' => 'required|string',
            'bmi' => 'required|string',
            'chf' => 'required|string',
            'heartRate' => 'required|string',
            'respiratoryRate' => 'required|string',
            'temperature' => 'required|string',
            'glycemia' => 'required|string',
            'bloodPressure' => 'required|string',
            'oxygenSaturation' => 'required|string',
            'externalHabitus' => 'required|string',
            'testSystems' => 'array',
            'testSystems.*' => 'array',
            'testSystems.*.name' => 'string',
            'testSystems.*.value' => 'required|string',
            'testSystems.*.status' => 'required',
            'testPhysical' => 'array',
            'testPhysical.*' => 'array',
            'testPhysical.*.name' => 'string',
            'testPhysical.*.value' => 'required|string',
            'testPhysical.*.status' => 'required',
        ]);

        $physicalExamination = PhysicalExamination::updateOrCreate(
            ['medical_record_sections_id' => $this->sectionId],
            [
                'date' => $validated['date'],
                'time' => $validated['time'],
                'weight' => $validated['weight'],
                'height' => $validated['height'],
                'bmi' => $validated['bmi'],
                'chf' => $validated['chf'],
                'heart_rate' => $validated['heartRate'],
                'respiratory_rate' => $validated['respiratoryRate'],
                'temperature' => $validated['temperature'],
                'glycemia' => $validated['glycemia'],
                'blood_pressure' => $validated['bloodPressure'],
                'oxygen_saturation' => $validated['oxygenSaturation'],
                'external_habitus' => $validated['externalHabitus'],
                'test_systems' => json_encode($validated['testSystems']),
                'test_physical' => json_encode($validated['testPhysical']),
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $this->dispatch('show-notification', message: 'Datos guardados correctamente');
    }

    public function previous()
    {
        $this->save();
        $this->dispatch('previous-section');
    }

    public function mount()
    {
        $this->sectionId = Patient::find($this->patient['id'])->record->medicalRecordSections->where('name', 'clinic_history')->first()->id;
        $physicalExamination = PhysicalExamination::where('medical_record_sections_id', $this->sectionId)->first() ?? '';

        if ($physicalExamination) {
            $this->date = $physicalExamination->date;
            $this->time = Carbon::parse($physicalExamination->time)->format('H:i');
            $this->weight = $physicalExamination->weight;
            $this->height = $physicalExamination->height;
            $this->bmi = $physicalExamination->bmi;
            $this->chf = $physicalExamination->chf;
            $this->heartRate = $physicalExamination->heart_rate;
            $this->respiratoryRate = $physicalExamination->respiratory_rate;
            $this->temperature = $physicalExamination->temperature;
            $this->glycemia = $physicalExamination->glycemia;
            $this->bloodPressure = $physicalExamination->blood_pressure;
            $this->oxygenSaturation = $physicalExamination->oxygen_saturation;
            $this->externalHabitus = $physicalExamination->external_habitus;
            $this->testSystems = json_decode($physicalExamination->test_systems, true);
            $this->testPhysical = json_decode($physicalExamination->test_physical, true);
        }
    }
}; ?>

<div>
    <form wire:submit='save'>
        <section class="flex gap-10 mt-10">
            <div class="flex flex-col gap-2">
                <label for="test_date" class="md:text-xs 2xl:text-sm">Fecha</label>
                <input wire:model='date' type="date" id="test_date" class="py-1 rounded border-zinc-300 w-fit">
                @error('date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex flex-col gap-2">
                <label for="test_time" class="md:text-xs 2xl:text-sm">Hora</label>
                <input wire:model='time' type="time" id="test_time" class="py-1 rounded border-zinc-300 w-fit">
                @error('time')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </section>
    
        <section class="mt-8">
            <h3 class="text-2xl text-[#174075] mb-5">Signos Vitales</h3>
    
            <section class="grid grid-cols-8 gap-5">
                <div class="flex flex-col">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="weight">Peso</label>
                    <input wire:model='weight' type="text" id="weight" class="py-1 rounded border-zinc-300">
                    @error('weight')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="flex flex-col">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="height">Talla</label>
                    <input wire:model='height' type="text" id="height" class="py-1 rounded border-zinc-300">
                    @error('height')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="flex flex-col">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="bmi">IMC</label>
                    <input wire:model='bmi' type="text" id="bmi" class="py-1 rounded border-zinc-300">
                    @error('bmi')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="flex flex-col">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="chf">ICC</label>
                    <input wire:model='chf' type="text" id="chf" class="py-1 rounded border-zinc-300">
                    @error('chf')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="flex flex-col">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="heart_rate">Fr. Cardíaca</label>
                    <input wire:model='heartRate' type="text" id="heart_rate" class="py-1 rounded border-zinc-300">
                    @error('heartRate')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="flex flex-col">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="respiratory_rate">Fr. Resp</label>
                    <input wire:model='respiratoryRate' type="text" id="respiratory_rate" class="py-1 rounded border-zinc-300">
                    @error('respiratoryRate')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="flex flex-col">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="temperature">Temp</label>
                    <input wire:model='temperature' type="text" id="temperature" class="py-1 rounded border-zinc-300">
                    @error('temperature')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="flex flex-col">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="glycemia">Glucemia</label>
                    <input wire:model='glycemia' type="text" id="glycemia" class="py-1 rounded border-zinc-300">
                    @error('glycemia')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="flex flex-col col-span-5">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="blood_pressure">
                        Tensión Arterial (Categoría, Sistólica mm Hg, Diastólica mm Hg)
                    </label>
                    {{-- <input wire:model='bloodPressure' type="text" id="blood_pressure" class="py-1 rounded border-zinc-300"> --}}
                    <select wire:model='bloodPressure' id="blood_pressure" class="py-1 rounded border-zinc-300">
                        <option value="">Seleccione una opción</option>
                        <option value="normal">
                            Normal / menos de 120 y menos de 80
                        </option>
                        <option value="elevada">
                            Elevada / 120-129 y menos de 80
                        </option>
                        <option value="hipertensionUno">
                            Presión Arterial Alta (Hipertensión) NIVEL 1 / 130-139 o 80-69
                        </option>
                        <option value="hipertensionDos">
                            Presión Arterial Alta (Hipertensión) NIVEL 2 / 140 o Más Alta o 90 o Más Alta
                        </option>
                        <option value="crisisHipertension">
                            Crisis de hipertensión / Más Alta de 180 y/o Más Alta de 120
                        </option>
                    </select>
                    @error('bloodPressure')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="flex flex-col col-span-2 oxygenContainer">
                    <label class="md:text-xs 2xl:text-sm uppercase" for="oxygen_saturation">Saturación de oxígeno</label>
                    <input wire:model='oxygenSaturation' type="text" id="oxygen_saturation" class="py-1 rounded border-zinc-300 relative">
                    @error('oxygenSaturation')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </section>
            
        </section>
    
        <section>
            <h3 class="text-2xl text-[#174075] my-5">Habitus exterior</h3>
            <div class="w-full">
                <textarea wire:model='externalHabitus' class="w-full rounded border-zinc-300" id="external_habitus" rows="6"></textarea>
                @error('externalHabitus')
                        <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </section>

        <section class="flex flex-col gap-6">

            <h3 class="text-2xl text-[#174075] my-3">Interrogatorio por aparatos y sistemas</h3>

            @foreach ($testSystems as $key => $test)
                <section>
                    <div class="flex items-center gap-5">
                        <div class="flex flex-col gap-2 w-full">
                            <label for="{{$key}}" class="uppercase md:text-xs 2xl:text-sm">{{$test['name']}}</label>
                            <input type="text" class="w-full py-1 rounded border-zinc-300" id="{{$key}}" wire:model='testSystems.{{$key}}.value'>
                        </div>

                        <div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <label for="{{$key}}_anormal" class="md:text-xs 2xl:text-sm">Anormal</label>
                                    <input type="radio" class="bg-gray-300 border-none" name="{{$key}}" id="{{$key}}_anormal" wire:model='testSystems.{{$key}}.status' value="anormal">
                                </div>
        
                                <div class="flex items-center gap-2">
                                    <label for="{{$key}}_normal" class="md:text-xs 2xl:text-sm">Normal</label>
                                    <input type="radio" class="bg-gray-300 border-none" name="{{$key}}" id="{{$key}}_normal" wire:model='testSystems.{{$key}}.status' value="normal">
                                </div>
                            </div>

                            @error('testSystems.' . $key . '.status')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @error('testSystems.' . $key . '.value')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </section>
            @endforeach
        </section>

        <section class="flex flex-col gap-6">

            <h3 class="text-2xl text-[#174075] my-3">Exploración física</h3>

            @foreach ($testPhysical as $key => $test)
                <section>
                    <div class="flex items-center gap-5">
                        <div class="flex flex-col gap-2 w-full">
                            <label for="{{$key}}" class="uppercase md:text-xs 2xl:text-sm">{{$test['name']}}</label>
                            <input type="text" class="w-full py-1 rounded border-zinc-300" id="{{$key}}" wire:model='testPhysical.{{$key}}.value'>
                        </div>

                        <div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <label for="{{$key}}_anormal" class="md:text-xs 2xl:text-sm">Anormal</label>
                                    <input type="radio" class="bg-gray-300 border-none" name="{{$key}}" id="{{$key}}_anormal" wire:model='testPhysical.{{$key}}.status' value="anormal">
                                </div>
        
                                <div class="flex items-center gap-2">
                                    <label for="{{$key}}_normal" class="md:text-xs 2xl:text-sm">Normal</label>
                                    <input type="radio" class="bg-gray-300 border-none" name="{{$key}}" id="{{$key}}_normal" wire:model='testPhysical.{{$key}}.status' value="normal">
                                </div>
                            </div>

                            @error('testPhysical.' . $key . '.status')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @error('testPhysical.' . $key . '.value')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </section>
            @endforeach
        </section>

        <div class="flex items-center justify-end mt-8">
            <div class="flex gap-3">
                <button wire:click.prevent='previous'  class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Anterior
                </button>
    
                <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
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
    const oxygenInput = document.getElementById('oxygen_saturation');

    $wire.on('previous-section', () => {
        setTimeout(() => {
            window.location.href = '/dashboard/expedientes/{{$patient['id']}}/medical-record/no-pathological-history';
        }, 2000);
    });

    oxygenInput.addEventListener('change', (e) => {
        if (e.target.value === '' || oxygenInput.value.includes('%')) {
            return;
        }

        e.target.value = e.target.value + '%';
    });
</script>
@endscript