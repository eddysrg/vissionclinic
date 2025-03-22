<?php

use JetBrains\PhpStorm\NoReturn;
use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\{Patient, PathologicalHistory, Exanthematic, ChronicDegenerativeDisease, OtherHistory};
use Illuminate\View\View;


new
#[Layout('components.layout.record')]
#[Title('Antecedentes Patológicos - Vission Clinic ECE')]
class extends Component {
    public $patient;
    public $medicalRecordId;
    public $pathologicalHistory;
    public $exanthematics = [];
    public $chronicDegenerativeDiseases = [];
    public $otherHistory = [];

    public function save(): void
    {
        foreach ($this->exanthematics as $exanthematic) {
            Exanthematic::updateOrCreate(
                [
                    'disease' => $exanthematic['disease'],
                    'pathological_history_id' => $this->pathologicalHistory->id
                ],
                $exanthematic
            );
        }

        foreach ($this->chronicDegenerativeDiseases as $disease) {
            ChronicDegenerativeDisease::updateOrCreate(
                [
                    'disease' => $disease['disease'],
                    'pathological_history_id' => $this->pathologicalHistory->id
                ],
                $disease
            );
        }

        foreach ($this->otherHistory as $history) {
            OtherHistory::updateOrCreate(
                [
                    'type_of_history' => $history['type_of_history'],
                    'pathological_history_id' => $this->pathologicalHistory->id
                ],
                $history
            );
        }

        $route = route('dashboard.record.pathological-history', ['id' => $this->patient->id]);
        $this->dispatch('show-noti', message: 'Antecedentes guardados correctamente', link: $route);

    }

    public function previous() {
        $route = route('dashboard.record.family-history', ['id' => $this->patient->id]);
        $this->dispatch('show-noti', message: 'Antecedentes guardados correctamente', link: $route);
    }

    public function next() {
        $route = route('dashboard.record.non-pathological-history', ['id' => $this->patient->id]);
        $this->dispatch('show-noti', message: 'Antecedentes guardados correctamente', link: $route);
    }

    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
        $this->medicalRecordId = $this->patient->load('record.medicalRecord')->record->medicalRecord->id;
        $this->pathologicalHistory = PathologicalHistory::where('medical_record_id', $this->medicalRecordId)->first();

        if(!empty($this->pathologicalHistory->exanthematics)) {
            $this->exanthematics = $this->pathologicalHistory->exanthematics->toArray();
        }

        if(!empty($this->pathologicalHistory->chronicDegenerativeDiseases->toArray())) {
            $this->chronicDegenerativeDiseases = $this->pathologicalHistory->chronicDegenerativeDiseases->toArray();
        }

        if(!empty($this->pathologicalHistory->otherHistories->toArray())) {
            $this->otherHistory = $this->pathologicalHistory->otherHistories->toArray();

            $indexes = [1, 2, 4, 5, 6];

            foreach ($indexes as $index) {
                if(isset($this->otherHistory[$index]['date'])) {
                    $this->otherHistory[$index]['date'] = $this->pathologicalHistory->otherHistories[$index]['date']->format('Y-m-d');
                } else {
                    return;
                }
            }
        }
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

<div>
    <x-record-notification/>

    @if(session('success'))
        <p>{{session('success')}}</p>
    @endif

    <h2 class="text-3xl text-[#174075]">Antecedentes Patológicos</h2>

    <form wire:submit='save'>
        <article class="grid grid-cols-2 gap-5 mt-10">
            <section>
                <div class="grid grid-cols-3 gap-2">
                    <h4 class="text-[#41759D]">Exantemáticas</h4>
                    <h4 class="justify-self-center">Aplica</h4>
                    <h4 class="justify-self-center">Observaciones</h4>

                    <p>Varicela</p>
                    <x-toggle-btn wire:model='exanthematics.0.applies' name="varicela" />
                    <input
                    type="text"
                    class="py-1 rounded border-zinc-300"
                    id="varicela-observation"
                    wire:model="exanthematics.0.observations">

                    <p>Rubeola</p>
                    <x-toggle-btn wire:model='exanthematics.1.applies' name="rubeola" />
                    <input wire:model='exanthematics.1.observations' type="text"
                        class="py-1 rounded border-zinc-300">

                    <p>Sarampión</p>
                    <x-toggle-btn wire:model='exanthematics.2.applies' name="sarampion" />
                    <input wire:model='exanthematics.2.observations' type="text"
                        class="py-1 rounded border-zinc-300">

                    <p>Escarlatina</p>
                    <x-toggle-btn wire:model='exanthematics.3.applies' name="escarlatina" />
                    <input wire:model='exanthematics.3.observations' type="text"
                        class="py-1 rounded border-zinc-300">

                    <p>Exantema súbito</p>
                    <x-toggle-btn wire:model='exanthematics.4.applies' name="exantemaSubito" />
                    <input wire:model='exanthematics.4.observations' type="text"
                        class="py-1 rounded border-zinc-300">
                </div>


                <div class="flex items-center gap-10 mt-8">
                    <h4 class="text-[#41759D]">Parasitarias</h4>
                    <input wire:model='otherHistory.0.observations' type="text" class="py-1 rounded border-zinc-300">
                </div>

                <div class="grid grid-cols-3 gap-2 mt-8">
                    <h4 class="text-[#41759D] col-span-3">Enfermedad crónica degenerativas</h4>

                    <p>Obesidad</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.0.applies' name="obesidad" />
                    <input wire:model='chronicDegenerativeDiseases.0.observations' type="text"
                        class="py-1 rounded border-zinc-300">

                    <p>Diabetes Mellitus</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.1.applies' name="diabetes" />
                    <input wire:model='chronicDegenerativeDiseases.1.observations' type="text"
                        class="py-1 rounded border-zinc-300">

                    <p>Hipertensión arterial</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.2.applies' name="hipertension" />
                    <input wire:model='chronicDegenerativeDiseases.2.observations' type="text"
                        class="py-1 rounded border-zinc-300">

                    <p>Dislipidemia</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.3.applies' name="dislipidemia" />
                    <input wire:model='chronicDegenerativeDiseases.3.observations' type="text"
                        class="py-1 rounded border-zinc-300">

                    <p>Neoplasias</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.4.applies' name="neoplasias" />
                    <input wire:model='chronicDegenerativeDiseases.4.observations' type="text"
                        class="py-1 rounded border-zinc-300">

                    <p>Neurológicas</p>
                    <x-toggle-btn wire:model='chronicDegenerativeDiseases.5.applies' name="neurologicas" />
                    <input wire:model='chronicDegenerativeDiseases.5.observations' type="text"
                        class="py-1 rounded border-zinc-300">

                    {{--<p>Otras</p>
                    <input wire:model='otherDiseases.otras' type="text" class="py-1 rounded border-zinc-300 col-span-2">--}}
                </div>

            </section>

            <section>
                <h4 class="text-[#41759D] mb-2">Traumáticos</h4>

                <div class="flex gap-3">
                    <div>
                        <label class="text-sm" for="traumatic_date">Fecha</label>
                        <input wire:model='otherHistory.1.date' type="date" id="traumatic_date"
                            class="py-1 rounded border-zinc-300">
                    </div>
                    <input wire:model='otherHistory.1.observations' type="text"
                        class="py-1 rounded border-zinc-300" placeholder="Observaciones">
                </div>

                <h4 class="text-[#41759D] mt-5">Fracturas</h4>

                <div class="flex flex-wrap gap-3">
                    <div>
                        <label class="text-sm" for="fracture_date">Fecha</label>
                        <input wire:model='otherHistory.2.date' type="date" id="fracture_date"
                            class="py-1 rounded border-zinc-300">
                    </div>
                    <div>
                        <label class="text-sm" for="type_fracture">Tipo</label>
                        <input wire:model='otherHistory.2.type_of_examination' type="text" id="type_fracture"
                            class="py-1 rounded border-zinc-300">
                    </div>
                    <input wire:model='otherHistory.2.observations' type="text"
                        class="py-1 rounded border-zinc-300" placeholder="Observaciones">
                </div>

                <h4 class="text-[#41759D] mt-5">Alérgicos</h4>
                <textarea wire:model='otherHistory.3.observations' name="" id="" cols="30" rows="3"
                    class="rounded border-zinc-300"></textarea>

                <h4 class="text-[#41759D] mt-5">Quirúrgicos</h4>
                <div class="flex flex-wrap gap-3">
                    <div>
                        <label class="text-sm" for="surgical_date">Fecha</label>
                        <input wire:model='otherHistory.4.date' type="date" id="surgical_date"
                            class="py-1 rounded border-zinc-300">
                    </div>

                    <div>
                        <label class="text-sm" for="surgical_type">Tipo</label>
                        <input wire:model='otherHistory.4.type_of_examination' type="text" id="surgical_type"
                            class="py-1 rounded border-zinc-300">
                    </div>

                    <div class="w-full">
                        <input wire:model='otherHistory.4.observations' type="text"
                            class="w-full py-1 rounded border-zinc-300" placeholder="Presencia o no de complicaciones">
                    </div>

                </div>

                <h4 class="text-[#41759D] mt-5">Hospitalizaciones previas</h4>
                <div class="flex flex-wrap gap-3">
                    <div>
                        <label class="text-sm" for="hospitalizations_date">Fecha</label>
                        <input wire:model='otherHistory.5.date' id="hospitalizations_date" type="date"
                            class="py-1 rounded border-zinc-300">
                    </div>

                    <div>
                        <label class="text-sm" for="hospitalizations_reason">Motivo de ingreso</label>
                        <input wire:model='otherHistory.5.observations' type="text" id="hospitalizations_reason"
                            class="py-1 rounded border-zinc-300">
                    </div>
                </div>

                <h4 class="text-[#41759D] mt-5">Transfusionales</h4>
                <div class="flex flex-wrap gap-3">
                    <div>
                        <label class="text-sm" for="transfusional_date">Fecha</label>
                        <input wire:model='otherHistory.6.date' type="date" id="transfusional_date"
                            class="py-1 rounded border-zinc-300">
                    </div>

                    <div>
                        <label class="text-sm" for="transfusional_type">Tipo de componente</label>
                        <input wire:model='otherHistory.6.type_of_examination' type="text" id="transfusional_type"
                            class="py-1 rounded border-zinc-300">
                    </div>

                    <div>
                        <label class="text-sm" for="transfusional_reason">Motivo de ingreso</label>
                        <input wire:model='otherHistory.6.observations' type="text" id="transfusional_reason"
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

