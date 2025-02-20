<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\{Patient, PathologicalHistory};



new 
#[Layout('layouts.record')] 
#[Title('Antecedentes Patológicos - Vission Clinic ECE')]
class extends Component {

    public $patient;
    public $id;

    public $sectionId;

    public $exanthematicDiseases = [
        'varicela' => [
            'applies' => false,
            'observation' => ''
        ],
        'rubeola' => [
            'applies' => false,
            'observation' => ''
        ],
        'sarampion' => [
            'applies' => false,
            'observation' => ''
        ],
        'escarlatina' => [
            'applies' => false,
            'observation' => ''
        ],
        'exantemaSubito' => [
            'applies' => false,
            'observation' => ''
        ],
    ];

    public $chronicDegenerativeDiseases = [
        'obesidad' => [
            'applies' => false,
            'observation' => ''
        ],
        'diabetes' => [
            'applies' => false,
            'observation' => ''
        ],
        'hipertension' => [
            'applies' => false,
            'observation' => ''
        ],
        'dislipidemia' => [
            'applies' => false,
            'observation' => ''
        ],
        'neoplasias' => [
            'applies' => false,
            'observation' => ''
        ],
        'neurologicas' => [
            'applies' => false,
            'observation' => ''
        ],
    ];

    public $otherDiseases = [
        'parasitarias' => '',
        'otras' => '',
        'traumaticos' => [
            'fecha' => '',
            'observaciones' => '',
        ],
        'fracturas' => [
            'fecha' => '',
            'tipo' => '',
            'observaciones' => '',
        ],
        'alergicos' => '',
        'quirurgicos' => [
            'fecha' => '',
            'tipo' => '',
            'complicaciones' => '',
        ],
        'hospitalizaciones' => [
            'fecha' => '',
            'motivo' => '',
        ],
        'transfusionales' => [
            'fecha' => '',
            'tipo' => '',
            'motivo' => '',
        ],

    ];
    
    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
        $this->authorize('viewRecord', $this->patient);
        $this->id = $id;
        $this->sectionId = Patient::find($this->patient['id'])->record->medicalRecordSections->where('name', 'clinic_history')->first()->id;

        $pathologicalHistory = PathologicalHistory::where('medical_record_sections_id', $this->sectionId)->first() ?? '';
        if($pathologicalHistory) {
            $this->exanthematicDiseases = json_decode($pathologicalHistory->exanthematic_diseases, true);
            $this->chronicDegenerativeDiseases = json_decode($pathologicalHistory->chronic_degenerative_diseases, true);
            $this->otherDiseases = json_decode($pathologicalHistory->other_diseases, true);
        }

    }
}; ?>

<div>
    <x-slot:id>
        {{$id}}
    </x-slot>

    <x-notification/>

    <h2 class="text-3xl text-[#174075]">Antecedentes Patológicos</h2>

    <form wire:submit='save'>
        <article class="grid grid-cols-2 gap-5 mt-10">
            <section>
                <div class="grid grid-cols-3 gap-2">
                    <h4 class="text-[#41759D]">Exantemáticas</h4>
                    <h4 class="justify-self-center">Aplica</h4>
                    <h4 class="justify-self-center">Observaciones</h4>
    
                    <p>Varicela</p>

                    <x-toggle-btn wire:model='exanthematicDiseases.varicela.applies' name="varicela" />

                    <input 
                    wire:model='exanthematicDiseases.varicela.observation' 
                    type="text" 
                    id="varicela-observation"
                    class="py-1 rounded border-zinc-300">
    
                    <p>Rubeola</p>

                    <x-toggle-btn wire:model='exanthematicDiseases.rubeola.applies' name="rubeola" />

                    <input wire:model='exanthematicDiseases.rubeola.observation' type="text"
                        class="py-1 rounded border-zinc-300">
    
                    <p>Sarampión</p>
                    
                    <x-toggle-btn wire:model='exanthematicDiseases.sarampion.applies' name="sarampion" />

                    <input wire:model='exanthematicDiseases.sarampion.observation' type="text"
                        class="py-1 rounded border-zinc-300">
    
                    <p>Escarlatina</p>
                    
                    <x-toggle-btn wire:model='exanthematicDiseases.escarlatina.applies' name="escarlatina" />

                    <input wire:model='exanthematicDiseases.escarlatina.observation' type="text"
                        class="py-1 rounded border-zinc-300">
    
                    <p>Exantema súbito</p>

                    <x-toggle-btn wire:model='exanthematicDiseases.exantemaSubito.applies' name="exantemaSubito" />

                    <input wire:model='exanthematicDiseases.exantemaSubito.observation' type="text"
                        class="py-1 rounded border-zinc-300">
                </div>
    
    
                <div class="flex items-center gap-10 mt-8">
                    <h4 class="text-[#41759D]">Parasitarias</h4>
                    <input wire:model='otherDiseases.parasitarias' type="text" class="py-1 rounded border-zinc-300">
                </div>
    
                <div class="grid grid-cols-3 gap-2 mt-8">
                    <h4 class="text-[#41759D] col-span-3">Enfermedad crónica degenerativas</h4>
    
                    <p>Obesidad</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.obesidad.applies' name="obesidad" />
                    <input wire:model='chronicDegenerativeDiseases.obesidad.observation' type="text"
                        class="py-1 rounded border-zinc-300">
    
                    <p>Diabetes Mellitus</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.diabetes.applies' name="diabetes" />
                    <input wire:model='chronicDegenerativeDiseases.diabetes.observation' type="text"
                        class="py-1 rounded border-zinc-300">
    
                    <p>Hipertensión arterial</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.hipertension.applies' name="hipertension" />
                    <input wire:model='chronicDegenerativeDiseases.hipertension.observation' type="text"
                        class="py-1 rounded border-zinc-300">
    
                    <p>Dislipidemia</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.dislipidemia.applies' name="dislipidemia" />
                    <input wire:model='chronicDegenerativeDiseases.dislipidemia.observation' type="text"
                        class="py-1 rounded border-zinc-300">
    
                    <p>Neoplasias</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.neoplasias.applies' name="neoplasias" />
                    <input wire:model='chronicDegenerativeDiseases.neoplasias.observation' type="text"
                        class="py-1 rounded border-zinc-300">
    
                    <p>Neurológicas</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.neurologicas.applies' name="neurologicas" />
                    <input wire:model='chronicDegenerativeDiseases.neurologicas.observation' type="text"
                        class="py-1 rounded border-zinc-300">
    
                    <p>Otras</p>
                    <input wire:model='otherDiseases.otras' type="text" class="py-1 rounded border-zinc-300 col-span-2">
                </div>
    
            </section>
    
            <section>
                <h4 class="text-[#41759D] mb-2">Traumáticos</h4>
    
                <div class="flex gap-3">
                    <div>
                        <label class="text-sm" for="traumatic_date">Fecha</label>
                        <input wire:model='otherDiseases.traumaticos.fecha' type="date" id="traumatic_date"
                            class="py-1 rounded border-zinc-300">
                    </div>
                    <input wire:model='otherDiseases.traumaticos.observaciones' type="text"
                        class="py-1 rounded border-zinc-300" placeholder="Observaciones">
                </div>
    
                <h4 class="text-[#41759D] mt-5">Fracturas</h4>
    
                <div class="flex flex-wrap gap-3">
                    <div>
                        <label class="text-sm" for="fracture_date">Fecha</label>
                        <input wire:model='otherDiseases.fracturas.fecha' type="date" id="fracture_date"
                            class="py-1 rounded border-zinc-300">
                    </div>
                    <div>
                        <label class="text-sm" for="type_fracture">Tipo</label>
                        <input wire:model='otherDiseases.fracturas.tipo' type="text" id="type_fracture"
                            class="py-1 rounded border-zinc-300">
                    </div>
                    <input wire:model='otherDiseases.fracturas.observaciones' type="text"
                        class="py-1 rounded border-zinc-300" placeholder="Observaciones">
                </div>
    
                <h4 class="text-[#41759D] mt-5">Alérgicos</h4>
                <textarea wire:model='otherDiseases.alergicos' name="" id="" cols="30" rows="3"
                    class="rounded border-zinc-300"></textarea>
    
                <h4 class="text-[#41759D] mt-5">Quirúrgicos</h4>
                <div class="flex flex-wrap gap-3">
                    <div>
                        <label class="text-sm" for="surgical_date">Fecha</label>
                        <input wire:model='otherDiseases.quirurgicos.fecha' type="date" id="surgical_date"
                            class="py-1 rounded border-zinc-300">
                    </div>
    
                    <div>
                        <label class="text-sm" for="surgical_type">Tipo</label>
                        <input wire:model='otherDiseases.quirurgicos.tipo' type="text" id="surgical_type"
                            class="py-1 rounded border-zinc-300">
                    </div>
    
                    <div class="w-full">
                        <input wire:model='otherDiseases.quirurgicos.complicaciones' type="text"
                            class="w-full py-1 rounded border-zinc-300" placeholder="Presencia o no de complicaciones">
                    </div>
    
                </div>
    
                <h4 class="text-[#41759D] mt-5">Hospitalizaciones previas</h4>
                <div class="flex flex-wrap gap-3">
                    <div>
                        <label class="text-sm" for="hospitalizations_date">Fecha</label>
                        <input wire:model='otherDiseases.hospitalizaciones.fecha' id="hospitalizations_date" type="date"
                            class="py-1 rounded border-zinc-300">
                    </div>
    
                    <div>
                        <label class="text-sm" for="hospitalizations_reason">Motivo de ingreso</label>
                        <input wire:model='otherDiseases.hospitalizaciones.motivo' type="text" id="hospitalizations_reason"
                            class="py-1 rounded border-zinc-300">
                    </div>
                </div>
    
                <h4 class="text-[#41759D] mt-5">Transfusionales</h4>
                <div class="flex flex-wrap gap-3">
                    <div>
                        <label class="text-sm" for="transfusional_date">Fecha</label>
                        <input wire:model='otherDiseases.transfusionales.fecha' type="date" id="transfusional_date"
                            class="py-1 rounded border-zinc-300">
                    </div>
    
                    <div>
                        <label class="text-sm" for="transfusional_type">Tipo de componente</label>
                        <input wire:model='otherDiseases.transfusionales.tipo' type="text" id="transfusional_type"
                            class="py-1 rounded border-zinc-300">
                    </div>
    
                    <div>
                        <label class="text-sm" for="transfusional_reason">Motivo de ingreso</label>
                        <input wire:model='otherDiseases.transfusionales.motivo' type="text" id="transfusional_reason"
                            class="py-1 rounded border-zinc-300">
                    </div>
                </div>
            </section>
        </article>
    
        <div class="flex justify-end gap-3 mt-10">
            <button wire:click.prevent='previous' class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Anterior
            </button>
    
            <button wire:click.prevent='next' class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Siguiente
            </button>
    
            <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Guardar
            </button>
        </div>
    </form>
</div>

@script
<script>
    $wire.on('previous-section', () => {
        setTimeout(() => {
            window.location.href = '/dashboard/expedientes/{{$patient['id']}}/medical-record/family-medical-history';
        }, 2000);
    });

    $wire.on('next-section', () => {
        setTimeout(() => {
            window.location.href = '/dashboard/expedientes/{{$patient['id']}}/medical-record/no-pathological-history';
        }, 2000);
    });
</script>
@endscript