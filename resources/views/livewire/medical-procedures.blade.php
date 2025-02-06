<?php

use Livewire\Volt\Component;
use App\Models\Procedure;

new class extends Component {
    public $searchInput = '';
    public $results = [];
    public $medicalProcedures = [];

    public function search()
    {
        if($this->searchInput === '') {
            $this->cleanSearch();
            return;
        }

        $procedures = Procedure::where('name', 'like', '%' . $this->searchInput . '%')->get();

        if($procedures->count() > 0) {
            $this->results = $procedures;
        } else {
            $this->results = [];
        }
    }

    public function addProcedure($id)
    {
        $procedure = Procedure::find($id);

        if($procedure && !collect($this->medicalProcedures)->pluck('id')->contains($procedure->id)) {
            $this->medicalProcedures[] = [
                'id' => $procedure->id,
                'catalog_key' => $procedure->catalog_key,
                'name' => $procedure->name,
            ];

            $this->dispatch('setMedicalProcedures', medicalProcedures: $this->medicalProcedures);
        }
    }

    public function removeProcedure($id)
    {
        $this->medicalProcedures = collect($this->medicalProcedures)->reject(fn($item) => $item['id'] === $id)->toArray();
        $this->dispatch('removeProcedure', id: $id);
    }

    public function updatedSearchInput()
    {
        $this->results = Procedure::where('name', 'like', '%' . $this->searchInput . '%')->get();
    }

    public function cleanSearch()
    {
        $this->searchInput = '';
        $this->results = [];
    }
}; ?>
    
<fieldset class="mb-4 mt-10">
    <div class="flex items-center justify-between">
        <legend class="text-[#174075] text-xl">Procedimientos médicos (CIE9)</legend>

        <div class="flex justify-end">
            <button x-on:click.prevent="$dispatch('open-modal', 'addProcedure')" class="bg-[#41759D] text-white py-2 px-3 rounded text-xs">+ Agregar procedimiento</button>
        </div>
    </div>

    <x-modal :show="false" clean="cleanSearch()" name="addProcedure" maxWidth="3xl">
        <section>
            <label for="procedureSearch" class="block font-semibold">Nombre del procedimiento o código CIE9-MC</label>
            <div class="flex items-center gap-3">
                <input wire:model='searchInput' type="text" id="procedureSearch" class="border-none bg-zinc-200 rounded-md py-1 flex-1">
                <button wire:click.prevent='search' class="bg-[#41759D] py-2 px-5 rounded text-white text-xs">Buscar procedimiento</button>
            </div>
    
            <table class="mt-5 w-full border-collapse rounded-md overflow-hidden">
                <thead class="bg-[#174075] text-white">
                    <tr>
                        <th class="text-sm p-2">Clave</th>
                        <th class="text-sm p-2">Nombre del procedimiento</th>
                    </tr>
                </thead>
                <tbody>
    
                    @forelse ($results as $result)
                        <tr class="bg-zinc-200">
                            <td class="p-2 text-center font-semibold text-sm">
                                <button wire:click.prevent='addProcedure({{$result->id}})' class="text-cyan-700 border-b border-cyan-700">
                                    {{$result->catalog_key}}
                                </button>
                                
                            </td>
                            <td class="p-2 text-sm">
                                <button wire:click.prevent='addProcedure({{$result->id}})' class="text-cyan-700 border-b border-cyan-700">
                                    {{$result->name}}
                                </button>
                            </td>
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
                <th class="w-2/4 text-sm px-3 py-2">Procedimiento</th>
                <th class="text-xs px-3 py-2">Acciones</th>
            </tr>
        </thead>

        <tbody class="bg-zinc-200">
            @forelse ($medicalProcedures as $procedure)
                <tr>
                    <td class="p-2 text-sm text-center font-semibold">{{$procedure['catalog_key']}}</td>
                    <td class="p-2 text-sm text-center">{{$procedure['name']}}</td>
                    <td class="p-2 text-sm text-center capitalize">
                        <button wire:click.prevent='removeProcedure({{$procedure['id']}})' wire:confirm='¿Estás seguro de eliminar este procedimiento?'>
                            <i class="fa-solid fa-circle-xmark text-red-500"></i>
                        </button>
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
</fieldset>
