<?php

use Livewire\Volt\Component;
use App\Models\Patient;
use App\Models\User;
use App\Models\Appointment;
use Livewire\Attributes\On; 
use Carbon\Carbon;


new class extends Component {

    // protected $listeners = ['setDateValues'];

    public $search;

    public $chosenPatient = '';
    public $doctor;

    public $date = '';
    public $time = '';
    public $type = '';
    public $comments = '';
    public $confirmed = '';

    public function createAppointment()
    {
        if(!$this->chosenPatient){
            return;
        }

        $validated = $this->validate([
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'type' => ['required', 'in:1,2,3,4,5,6,7'],
            'comments' => ['required', 'string'],
            'confirmed' => ['required', 'in:0,1'],
        ]);

        $validated['patient_id'] = $this->chosenPatient->id;

        Appointment::create($validated);
        $this->clearForm();
        $this->dispatch('close-modal', 'appointmentModal');
        $this->dispatch('show-notification', message: 'Cita guardada con éxito');

    }

    public function searchPatient()
    {
        
        if(empty($this->search)) {
            $this->chosenPatient = '';
            return collect();
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

    public function setPatientData($id)
    {
        $this->chosenPatient = Patient::find($id);
        $this->doctor = User::find($this->chosenPatient->doctor_id)->name;
    }

    public function clearForm()
    {
        $this->search = '';
        $this->chosenPatient = '';
        $this->doctor = '';
        $this->date = '';
        $this->time = '';
        $this->type = '';
        $this->comments = '';
        $this->confirmed = '';

        $this->resetErrorBag();
    }

    #[On('setDateValues')] 
    public function setDateValues($dateInfo)
    {
        $typeDate = $dateInfo['view']['type'];
        $formattedDate = Carbon::parse($dateInfo['date'])->format('Y-m-d');
        $formattedTime = Carbon::parse($dateInfo['date'])->format('H:i');

        switch ($typeDate) {
            case 'dayGridMonth':
                $this->date = $formattedDate;
                break;

            case 'timeGridWeek';
            case 'timeGridDay':
                $this->time = $formattedTime;
                $this->date = $formattedDate;
                break;
            default:
                break;
        }
    }

    public function with()
    {
        return [
            'patients' => $this->searchPatient(),
        ];
    }
}; ?>

<div>
    <x-appointment-modal name='appointmentModal' clean='clearForm'>
        <div>
            <section class="p-8">
                <h2 class="text-lg font-medium text-[#174075] mb-6">Buscar Paciente</h2>

                <form wire:submit='searchPatient'>
                    <div class="flex gap-5">
                        <input wire:model='search' id="search" type="text"
                            placeholder="Nombre | Apellido Paterno | Apellido Materno"
                            class="w-full rounded-full border border-zinc-300">
                        <button class="px-6 py-3 bg-[#41759D] text-white rounded" type="submit">Buscar</button>
                    </div>
                </form>

                <table class="w-full border mt-10">
                    <thead>
                        <tr>
                            <th class="py-3">N° Expediente</th>
                            <th class="py-3">Nombre Completo</th>
                            <th class="py-3">Número de contacto</th>
                            <th class="py-3">Agregar a la cita</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($patients as $patient)
                        <tr class="text-center bg-cyan-50">
                            <td class="py-3">
                                {{$patient->id}}
                            </td>

                            <td class="py-3">
                                {{$patient->name . ' ' . $patient->father_last_name . ' ' .
                                $patient->mother_last_name}}
                            </td>

                            <td class="py-3">
                                {{$patient->phone_number}}
                            </td>

                            <td class="py-3">
                                <button wire:click='setPatientData({{$patient->id}})'
                                    class="py-2 px-4 aspect-square rounded bg-[#41759D] text-white text-xl">+</button>
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
            </section>

            <section class=" p-8 bg-cyan-50">
                <h2 class="text-lg font-medium text-[#174075] mb-6">Agendar Cita</h2>

                @if($chosenPatient)
                <div class="flex gap-10">
                    <div>
                        <h3 class="font-medium">Nombre del paciente</h3>
                        <p>
                            {{$chosenPatient->name . ' ' . $chosenPatient->father_last_name . ' ' .
                            $chosenPatient->mother_last_name}}
                        </p>
                    </div>

                    <div>
                        <h3 class="font-medium">Nombre del Doctor</h3>
                        <p>
                            {{$doctor}}
                        </p>
                    </div>
                </div>
                @endif

                <form wire:submit='createAppointment' class="mt-10">
                    <div class="grid grid-cols-4 gap-5">
                        <div class="flex flex-col gap-3">
                            <label class="text-[#386486] font-semibold" for="date">Fecha de la cita</label>
                            <input class="border-0 bg-[#b5e6e9] rounded" wire:model='date' id="date" type="date">
                            @error('date')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3">
                            <label class="text-[#386486] font-semibold" for="time">Hora de la cita</label>
                            <input class="border-0 bg-[#b5e6e9] rounded" wire:model='time' id="time" type="time">
                            @error('time')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3">
                            <label class="text-[#386486] font-semibold" for="type">Tipo de consulta</label>
                            <select class="border-0 bg-[#b5e6e9] rounded" wire:model='type' name="" id="type">
                                <option value="">-- Selecciona una opción --</option>
                                <option value="1">Crónicos</option>
                                <option value="2">Sanos</option>
                                <option value="3">Planificación</option>
                                <option value="4">Enf. transmisibles</option>
                                <option value="5">Otras enfermedades</option>
                                <option value="6">Control de embarazo</option>
                                <option value="7">Control nutricional</option>
                            </select>
                            @error('type')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3">
                            <label class="text-[#386486] font-semibold" for="confirmed">Estatus de la cita</label>
                            <select class="border-0 bg-[#b5e6e9] rounded" wire:model='confirmed' name="confirmed"
                                id="confirmed">
                                <option value="">-- Selecciona una opción --</option>
                                <option value="0">Sin confirmar</option>
                                <option value="1">Confirmar</option>
                            </select>
                            @error('confirmed')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3 col-start-1 col-end-5">
                            <label class="text-[#386486] font-semibold" for="comments">Observaciones</label>
                            <textarea class="border-0 bg-[#b5e6e9] rounded" wire:model='comments' name="" id="comments"
                                cols="30" rows="10"></textarea>
                            @error('comments')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end">
                        @if ($chosenPatient)
                        <button class="mt-10 px-6 py-4 bg-amber-400 rounded font-semibold">Guardar
                            cita</button>
                        @else
                        <button disabled
                            class="cursor-not-allowed opacity-85 mt-10 px-6 py-4 bg-amber-300 text-opacity-75 rounded font-semibold">Guardar
                            cita</button>
                        @endif

                    </div>
                </form>
            </section>
        </div>
    </x-appointment-modal>


</div>