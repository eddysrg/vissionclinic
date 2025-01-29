<?php

use Livewire\Volt\Component;
use App\Models\Diagnosis;
use App\Livewire\Forms\MedicalConsultationForm;

new class extends Component {
    public $searchInput = '';
    public $results = [];
    public $newCase = [];
    public $diagnosisOfDiseases = [];

    public function search()
    {
        if($this->searchInput === '') {
            $this->cleanSearch();
            return;
        }

        $diagnoses = Diagnosis::where('name', 'like', '%' . $this->searchInput . '%')->get();

        if($diagnoses->count() > 0) {
            $this->results = $diagnoses;
        } else {
            $this->results = [];
        }
    }

    public function addDiagnosis($id)
    {
        if (!isset($this->newCase[$id])) {
            $this->dispatch('diagnosis-failed', message: 'Debe indicar si el caso es nuevo o no');
            return;
        }

        $diagnosis = Diagnosis::find($id);

        if($diagnosis && !collect($this->diagnosisOfDiseases)->pluck('id')->contains($diagnosis->id)) {
            $this->diagnosisOfDiseases[] = [
                'id' => $diagnosis->id,
                'catalog_key' => $diagnosis->catalog_key,
                'name' => $diagnosis->name,
                'form' => 'Capturar formulario',
                'newCase' => $this->newCase[$id],
                'study' => $diagnosis->require_epi_study,
                'status' => 'Estudio llenado',
            ];

            $this->dispatch('setDiagnosisOfDiseases', diagnosisOfDiseases: $this->diagnosisOfDiseases);
        }
    }

    public function removeDiagnosis($id)
    {
        $this->diagnosisOfDiseases = collect($this->diagnosisOfDiseases)->reject(fn($item) => $item['id'] === $id)->toArray();
        $this->dispatch('removeDisease', id: $id);
    }

    public function updatedSearchInput()
    {
        $this->results = Diagnosis::where('name', 'like', '%' . $this->searchInput . '%')->get();
    }

    public function cleanSearch()
    {
        $this->searchInput = '';
        $this->results = [];
    }

}; ?>

<fieldset class="mb-4 mt-10">
    <div class="flex items-center justify-between">
        <legend class="text-[#174075] text-xl">Diagnóstico de enfermedades (CIE10)</legend>

        <div class="flex justify-end">
            <button x-on:click.prevent="$dispatch('open-modal', 'addDiagnosis')" class="bg-[#41759D] text-white py-2 px-3 rounded text-xs">+ Agregar Diagnostico</button>
        </div>
    </div>
    

    

    <x-modal :show="false" clean="cleanSearch()" name="addDiagnosis" maxWidth="3xl">
        <section>
            <label for="procedureSearch" class="block font-semibold">Nombre del procedimiento o código CIE-10</label>
            <div class="flex items-center gap-3">
                <input wire:model='searchInput' type="text" id="procedureSearch" class="border-none bg-zinc-200 rounded-md py-1 flex-1">
                <button wire:click.prevent='search' class="bg-[#41759D] py-2 px-5 rounded text-white text-xs">Buscar diagnóstico</button>
            </div>
    
            <table class="mt-5 w-full border-collapse rounded-md overflow-hidden">
                <thead class="bg-[#174075] text-white">
                    <tr>
                        <th class="text-sm p-2">Clave</th>
                        <th class="text-sm p-2">Nombre de la enfermedad</th>
                        <th class="text-sm p-2">Caso nuevo</th>
                        <th class="text-sm p-2">Estúdio</th>
                    </tr>
                </thead>
                <tbody>
    
                    @forelse ($results as $result)
                        <tr class="bg-zinc-200">
                            <td class="p-2 text-center font-semibold text-sm">
                                <button wire:click.prevent='addDiagnosis({{$result->id}})' class="text-cyan-700 border-b border-cyan-700">
                                    {{$result->catalog_key}}
                                </button>
                                
                            </td>
                            <td class="p-2 text-sm">
                                <button wire:click.prevent='addDiagnosis({{$result->id}})' class="text-cyan-700 border-b border-cyan-700">
                                    {{$result->name}}
                                </button>
                            </td>
                            <td class="p-2 text-sm">
                                <section class="flex justify-center gap-5">
                                    <div class="flex items-center gap-2">
                                        <label for="{{$result->catalog_key}}_yes">Si</label>
                                        <input wire:model='newCase.{{$result->id}}' type="radio" id="{{$result->catalog_key}}_yes" name="{{$result->name}}" value="Si" class="border-none">
                                    </div>
    
                                    <div class="flex items-center gap-2">
                                        <label for="{{$result->catalog_key}}_no">No</label>
                                        <input wire:model='newCase.{{$result->id}}' type="radio" id="{{$result->catalog_key}}_no" name="{{$result->name}}" value="No" class="border-none">
                                    </div>
                                </section>
                            </td>
                            <td class="p-2 text-sm text-center">{{$result->require_epi_study}}</td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </section>
    </x-modal>


    <table class="mt-4 w-full border-collapse rounded-md overflow-hidden">
        <thead class="bg-[#174075] text-white">
            <tr>
                <th class="text-sm px-3 py-2">Código</th>
                <th class="w-2/4 text-sm px-3 py-2">Enfermedad</th>
                <th class="text-xs px-3 py-2">Formulario</th>
                <th class="text-xs px-3 py-2">Caso nuevo</th>
                <th class="text-xs px-3 py-2">¿Estudio?</th>
                <th class="text-xs px-3 py-2">Estatus</th>
                <th class="text-xs px-3 py-2">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($diagnosisOfDiseases as $disease)
                <tr>
                    <td class="p-2 text-sm text-center font-semibold">{{$disease['catalog_key']}}</td>
                    <td class="p-2 text-sm text-center">{{$disease['name']}}</td>
                    <td class="p-2 text-sm text-center">{{$disease['form']}}</td>
                    <td class="p-2 text-sm text-center">{{$disease['newCase']}}</td>
                    <td class="p-2 text-sm text-center">{{$disease['study']}}</td>
                    <td class="p-2 text-sm text-center">{{$disease['status']}}</td>
                    <td class="p-2 text-sm text-center capitalize">
                        <button wire:click.prevent='removeDiagnosis({{$disease['id']}})' wire:confirm='¿Estás seguro de eliminar este diagnóstico?'>
                            <i class="fa-solid fa-circle-xmark text-red-500"></i>
                        </button>
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
</fieldset>
