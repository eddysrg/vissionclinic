<?php

use Livewire\Attributes\{Layout, Title, Computed};
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Patient;


new
#[Layout('layouts.app')]
#[Title('Expedientes - Vission Clinic ECE')]
class extends Component {
    use WithPagination;

    protected $listeners = ['clearSearch'];

    public $search = '';

    #[Computed]
    public function searchPatient()
    {
        $terms = explode(' ' ,$this->search);

        return Patient::where('medical_unit_id', auth()->user()->medical_unit_id)
        ->latest()
        ->when($this->search, function ($query) {   
            $terms = explode(' ' ,$this->search);

            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->orWhere('name', 'like', "{$term}%")
                    ->orWhere('last_name', 'like', "{$term}%");
                }
            });
        })
        ->paginate(5);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function eliminatePatient($id)
    {
        Patient::findOrFail($id)->delete();
    }

    public function clearSearch()
    {
        $this->search = '';
    }

}; ?>

<main class="p-8">
    @livewire('components.patient')
    @livewire('components.appointment')
    <x-notification />

    <div class="flex gap-5">
        <input 
        wire:model.live='search' 
        id="search-patient" 
        type="text"
        placeholder="Nombre | Apellido Materno | Apellido Paterno | N° de expediente"
        class="w-full rounded-full border border-zinc-300">
    </div>

    <div class="grid grid-cols-[1fr_.4fr] gap-x-8 mt-10">
        <section>
            <table class="w-full border mb-10">
                <thead>
                    <tr>
                        <th class="py-3">N° Expediente</th>
                        <th class="py-3">Nombre Completo</th>
                        <th class="py-3">Número de contacto</th>
                        <th class="py-3">Editar</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($this->searchPatient as $patient)
                        <tr class="text-center bg-cyan-50">
                            <td class="py-3">
                                {{$patient->id}}
                            </td>

                            <td class="py-3">
                                <div class="flex justify-center items-center gap-5">
                                    <x-patient-initials :patient="$patient" size="8" fontSize="text-base" />

                                    <a href="{{route('dashboard.record.summary', $patient->id)}}"
                                        class="text-[#32ADE6] underline uppercase">
                                        {{$patient->full_name}}
                                    </a>
                                </div>
                            </td>

                            <td class="py-3">
                                {{$patient->phone_number}}
                            </td>

                            <td class="py-3">
                                <div class="flex items-center gap-4">
                                    <button wire:click='$dispatch("setPatientInfo", {id: {{$patient->id}}})'
                                        @click='$dispatch("open-modal", "patientModal")'>
                                        <i class="fa-solid fa-pen-to-square text-[#32ADE6]"></i>
                                    </button>

                                    <button wire:click="eliminatePatient({{$patient->id}})" wire:confirm='¿Está seguro de eliminar a este paciente?'>
                                        <i class="fa-solid fa-trash text-red-500"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        @if ($search)
                            <p class="mt-10 bg-red-300 border border-red-600 text-center text-red-700">
                                No se encuentran registros
                            </p>
                        @endif
                    @endforelse
                </tbody>
            </table>

            {{$this->searchPatient->links()}}
        </section>

        <section>
            <div>
                <h2 class="bg-[#0E2F5E] text-center p-2 text-white uppercase">Acciones Rápidas</h2>

                <div class="bg-[#13C6ED0D] flex flex-col gap-5 p-10 border">
                    <button x-data @click='$dispatch("open-modal", "patientModal")'
                        class="text-white bg-[#41759D] p-3 rounded-md">
                        Registro Paciente Nuevo
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>

                    <button x-data @click='$dispatch("open-modal", "appointmentModal")'
                        class="text-white bg-[#41759D] p-3 rounded-md">
                        Agendar cita
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>

                    <a href="{{route('dashboard.agenda')}}" class="text-center text-white bg-[#41759D] p-3 rounded-md">
                        Revisar agenda
                        <i class="fa-solid fa-plus ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    </div>
</main>


