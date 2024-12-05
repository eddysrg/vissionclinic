<?php

use Livewire\Volt\Component;
use App\Models\Patient;
use Livewire\WithPagination;


new class extends Component {
    use WithPagination;

    protected $listeners = ['clearSearch'];

    public $search = '';

    public function searchPatient()
    {
        
        if(empty($this->search)) {
            // $this->chosenPatient = '';
            return Patient::where('clinic_id', auth()->user()->clinic_id)->paginate(5);
        }

        $terms = explode(' ' ,$this->search);

        return $patients = Patient::where('clinic_id', auth()->user()->clinic_id)
        ->where(function($query) use ($terms) {
            foreach ($terms as $term) {
                $query->where(function($query) use ($term) {
                    $query->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('father_last_name', 'LIKE', "%{$term}%")
                    ->orWhere('mother_last_name', 'LIKE', "%{$term}%");
                });
            }
        })->get();
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function with()
    {
        return [
            'patients' => $this->searchPatient()
        ];
    }

}; ?>

<div class="p-8">
    <form wire:submit='searchPatient'>
        <div class="flex gap-5">
            <input wire:model='search' id="search" type="text"
                placeholder="Nombre | Apellido Materno | Apellido Paterno"
                class="w-full rounded-full border border-zinc-300">
            <button class="px-6 py-3 bg-[#41759D] text-white rounded" type="submit">Buscar</button>
        </div>
    </form>

    <main class="grid grid-cols-[1fr_.4fr] gap-x-8 mt-10">
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
                    @forelse ($patients as $patient)
                    <tr class="text-center bg-cyan-50">
                        <td class="py-3">
                            {{$patient->id}}
                        </td>

                        <td class="py-3">
                            <div class="flex justify-center items-center gap-5">
                                <x-patient-initials :patient="$patient" />

                                <a href="{{route('dashboard.expedientes.summary', $patient->id)}}"
                                    class="text-[#32ADE6] underline uppercase">
                                    {{$patient->name . ' ' . $patient->father_last_name . ' ' .
                                    $patient->mother_last_name}}
                                </a>
                            </div>
                        </td>

                        <td class="py-3">
                            {{$patient->phone_number}}
                        </td>

                        <td class="py-3">
                            <button wire:click='$dispatch("setPatientInfo", {id: {{$patient->id}}})'
                                @click='$dispatch("open-modal", "patientModal")'>
                                <i class="fa-solid fa-pen-to-square text-[#32ADE6]"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    @unless (!$search)
                    <p class="mt-10 bg-red-300 border border-red-600 text-center text-red-700">No se encuentran
                        registros</p>
                    @endunless
                    @endforelse
                </tbody>
            </table>
            @unless ($search)
            {{$patients->links()}}
            @endunless
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
    </main>




</div>