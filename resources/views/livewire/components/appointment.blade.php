<?php

use Livewire\Volt\Component;
use App\Models\{Patient, User, Appointment, MedicalUnit};
use Livewire\Attributes\On;
use Carbon\Carbon;
use App\Livewire\Forms\AppointmentForm;
use App\Services\AppointmentService;


new class extends Component {

    public $doctor;

    public $isEditing = false;

    // -------------------------------------

    public User $user;
    public $patients = [];
    public $doctors = [];
    public $search = '';
    public $chosenPatient = '';
    public AppointmentForm $form;


    public function updatedSearch()
    {
        $terms = explode(' ', $this->search);

        $this->patients = Patient::where('medical_unit_id', auth()->user()->medical_unit_id)
        ->where(function ($query) use ($terms) {
            foreach ($terms as $term) {
                $query->orWhere('name', 'like', "{$term}%")
                ->orWhere('last_name', 'like', "{$term}%");
            }
        })->get();
    }

    public function getAppointmentServiceProperty()
    {
        return app(AppointmentService::class);
    }

    public function createAppointment()
    {
        $validated = $this->form->validate();

        $this->appointmentService->createAppointment($validated);

        $this->clearForm();
        $this->dispatch('close-modal', 'appointmentModal');
        $this->dispatch('show-notification', message: 'Cita creada con éxito');
    }

    public function updateAppointment()
    {
        $validated = $this->form->validate();

        $this->appointmentService->updateAppointment($this->form->appointmentId, $validated);

        $this->clearForm();
        $this->dispatch('close-modal', 'appointmentModal');
        $this->dispatch('show-notification', message: 'Cita actualizada con éxito');

    }

    public function clearForm()
    {
        $this->search = '';
        $this->chosenPatient = '';
        $this->isEditing = false;

        $this->form->date = '';
        $this->form->time = '';
        $this->form->type = '';
        $this->form->comments = '';
        $this->form->status = '';
        $this->form->doctor_id = '';
        $this->form->patient_id = '';

        $this->form->resetErrorBag();
    }

    public function getAllDoctors()
    {
        return MedicalUnit::with(['users' => function ($query) {
            $query->where('role_id', 2);
        }])
        ->find($this->user)
        ->first()
        ->users;
    }

    // ------------

    public function setPatientData($id)
    {
        $this->chosenPatient = Patient::find($id);
        $this->form->patient_id = $this->chosenPatient->id;
        $this->search = '';
    }


    #[On('setDateValues')]
    public function setDateValues($dateInfo)
    {
        $typeDate = $dateInfo['view']['type'];
        $formattedDate = Carbon::parse($dateInfo['date'])->format('Y-m-d');
        $formattedTime = Carbon::parse($dateInfo['date'])->format('H:i');

        switch ($typeDate) {
            case 'dayGridMonth':
                $this->form->date = $formattedDate;
                break;

            case 'timeGridWeek';
            case 'timeGridDay':
                $this->form->time = $formattedTime;
                $this->form->date = $formattedDate;
                break;
            default:
                break;
        }
    }

    #[On('setAppointmentData')]
    public function setAppointmentData($id)
    {
        $appointment = Appointment::find($id);

        $this->isEditing = true;
        $this->form->appointmentId = $id;
        $this->setPatientData($appointment->patient_id);
        $this->form->date = $appointment->date->format('Y-m-d');
        $this->form->time = $appointment->time->format('H:i');
        $this->form->type = $appointment->type;
        $this->form->comments = $appointment->comments;
        $this->form->status = $appointment->status;
        $this->form->doctor_id = $appointment->doctor_id;

        $this->dispatch('open-modal', 'appointmentModal');
    }


    public function mount()
    {
        $this->user = auth()->user();
        $this->doctors = $this->getAllDoctors();
    }

}; ?>

<div>
    <x-appointment-modal name='appointmentModal' clean='clearForm' :show="false">
        <div>

            @if(!$isEditing)
                <section class="p-8">
                    <h2 class="text-lg font-medium text-[#174075] mb-6">Buscar Paciente</h2>

                    <div class="flex gap-5">
                        <input wire:model.live='search' id="search" type="text" placeholder="Nombre | Apellido Paterno | Apellido Materno"
                        class="w-full rounded-full border border-zinc-300">
                    </div>

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
                            @if ($search)
                                @forelse ($patients as $patient)
                                    <tr class="text-center bg-cyan-50">
                                        <td class="py-3">
                                            {{$patient->id}}
                                        </td>

                                        <td class="py-3">
                                            {{$patient->full_name}}
                                        </td>

                                        <td class="py-3">
                                            {{$patient->phone_number}}
                                        </td>

                                        <td class="py-3">
                                            <button wire:click='setPatientData({{$patient->id}})'class="py-2 px-4 aspect-square rounded bg-[#41759D] text-white text-xl">+</button>
                                        </td>
                                    </tr>
                                @empty
                                    <p class="mt-10 bg-red-300 border border-red-600 text-center text-red-700">
                                        No se encuentran registros
                                    </p>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </section>
            @endif


            <section class=" p-8 bg-cyan-50">
                <h2 class="text-lg font-medium text-[#174075] mb-6">Agendar Cita</h2>

                <form wire:submit='createAppointment' class="mt-10">
                    <div class="grid grid-cols-4 gap-5">

                        <div class="flex flex-col gap-3 col-span-2">
                            <label class="text-[#386486] font-semibold" for="doctor_id">Médico(a)</label>
                            <select class="border-0 bg-[#b5e6e9] rounded" wire:model='form.doctor_id' name="doctor_id"
                                id="doctor_id">
                                <option value="">Selecciona una opción</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{$doctor->id}}">{{$doctor->full_name}}</option>
                                @endforeach
                            </select>
                            @error('form.doctor_id')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3 col-span-2">
                            <label class="text-[#386486] font-semibold" for="patient_id">Nombre del paciente</label>
                            <select class="border-0 bg-[#b5e6e9] rounded" wire:model='form.patient_id' name="patient_id"
                                id="patient_id" disabled>
                                @if($chosenPatient)
                                    <option value="{{$chosenPatient->id}}">{{$chosenPatient->full_name}}</option>
                                @endif
                            </select>
                            @error('form.patient_id')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3">
                            <label class="text-[#386486] font-semibold" for="date">Fecha de la cita</label>
                            <input class="border-0 bg-[#b5e6e9] rounded" wire:model='form.date' id="date" type="date">
                            @error('form.date')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3">
                            <label class="text-[#386486] font-semibold" for="time">Hora de la cita</label>
                            <input class="border-0 bg-[#b5e6e9] rounded" wire:model='form.time' id="time" type="time">
                            @error('form.time')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3 col-span-2">
                            <label class="text-[#386486] font-semibold" for="type">Tipo de consulta</label>
                            <select class="border-0 bg-[#b5e6e9] rounded" wire:model='form.type' name="" id="type">
                                <option value="">Selecciona una opción</option>
                                <option value="chronic">Crónicos</option>
                                <option value="healthy">Sanos</option>
                                <option value="planning">Planificación</option>
                                <option value="sexually_transmitted_diseases">Enf. transmisibles</option>
                                <option value="other_diseases">Otras enfermedades</option>
                                <option value="pregnancy_control">Control de embarazo</option>
                                <option value="nutritional_control">Control nutricional</option>
                            </select>
                            @error('form.type')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3 col-span-2">
                            <label class="text-[#386486] font-semibold" for="status">Estatus de la cita</label>
                            <select class="border-0 bg-[#b5e6e9] rounded" wire:model='form.status' name="status"
                                id="status">
                                <option value="">Selecciona una opción</option>
                                <option value="unconfirm">Sin confirmar</option>
                                <option value="confirm">Confirmar</option>
                            </select>
                            @error('form.status')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3 col-start-1 col-end-5">
                            <label class="text-[#386486] font-semibold" for="comments">Observaciones</label>
                            <textarea class="border-0 bg-[#b5e6e9] rounded" wire:model='form.comments' id="comments"
                                cols="30" rows="10"></textarea>
                            @error('form.comments')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end">
                        @if ($isEditing)
                            <button wire:click.prevent='updateAppointment' class="mt-10 px-6 py-4 bg-amber-400 rounded font-semibold">
                                Editar Cita
                            </button>
                        @else
                            <button type="submit" class="mt-10 px-6 py-4 bg-amber-400 rounded font-semibold">
                                Guardar cita
                            </button>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </x-appointment-modal>


</div>
