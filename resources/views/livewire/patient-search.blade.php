<?php

use Livewire\Volt\Component;
use App\Models\Patient;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $queryElement = "";
    
    public function with()
    {
        return [
            'patients' => Patient::when($this->queryElement, function($query) {
                $query->where('patient_name', 'LIKE', '%' . $this->queryElement . '%');
            })
            ->when($this->queryElement, function($query) {
                $query->orWhere('fathers_last_name', 'LIKE', '%' . $this->queryElement . '%');
            })
            ->when($this->queryElement, function($query) {
                $query->orWhere('mothers_last_name', 'LIKE', '%' . $this->queryElement . '%');
            })
            ->when($this->queryElement, function($query) {
                $query->orWhere('id', 'LIKE', $this->queryElement);
            })
            ->paginate(5)
        ];  
    }
}; ?>

<div>
    <div>
        <form wire:submit="with" class="flex gap-5">
            <input autocomplete="off" id="patient_search" wire:model="queryElement" class="rounded-full w-5/12"
                type="search" placeholder="No. Expediente | Nombre | Apellido P. | Apellido M.">
            <button wire:click='dispatch("cleanAppointmentForm")' type="submit"
                class="bg-[#41759D] place-self-center px-8 py-2 rounded-lg text-white flex items-center gap-2">
                Buscar
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <div class="border border-zinc-300 mt-10">
        <div class="grid grid-cols-4 justify-items-center py-2 uppercase font-semibold">
            <h4>N° Expediente</h4>
            <h4>Nombre</h4>
            <h4>Número de contacto</h4>
            <h4>Acciones</h4>
        </div>

        @if($queryElement)
        @forelse ($patients as $patient)
        <div class="grid grid-cols-4 justify-items-center uppercase py-4 items-center bg-cyan-50">
            <p>{{$patient->id}}</p>
            <div class="flex gap-3 items-center justify-self-start">
                <div class="p-2 bg-[#174075] aspect-square rounded-full text-white">DH</div>
                <p class="text-[#03BCF6] underline ">
                    {{$patient->patient_name . ' ' . $patient->fathers_last_name . ' ' . $patient->mothers_last_name}}
                </p>
            </div>

            <p>
                {{$patient->phone_number}}
            </p>

            <button wire:click='$dispatch("patientInfo", {patient: {{$patient}}})'
                class="bg-[#41759D] aspect-square w-10 h-10 flex justify-center items-center rounded self-stretch">
                <i class="fa-solid fa-plus text-white"></i>
            </button>
        </div>
        @empty
        <p class="text-center py-5 text-lg font-semibold">No hay registros</p>
        @endforelse
        <div class="p-6">{{$patients->links()}}</div>
        @endif
    </div>


</div>