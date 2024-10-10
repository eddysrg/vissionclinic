<?php

use Livewire\Volt\Component;
use App\Models\Appointment;

new class extends Component {

    public $appointmentId;
    public $patient = [];
    public $appointmentData = [
        'appointment_date' => '',
        'appointment_time' => '',
        'appointment_type' => '',
        'appointment_comments' => '',
        'patient_id' => '',
        'confirmed' => ''
    ];

    public function mount()
    {
        $appointment = Appointment::find($this->appointmentId);

        if($appointment) {
            $this->patient = $appointment->patient;

            $this->appointmentData = [
                'appointment_date' => $appointment->appointment_date,
                'appointment_time' => $appointment->appointment_time,
                'appointment_type' => $appointment->appointment_type,
                'appointment_comments' => $appointment->appointment_comments,
                'patient_id' => $appointment->patient_id,
                'confirmed' => $appointment->confirmed
            ];

            return;
        }

        $this->appointmentData = null;
    }

    public function updateAppointment()
    {
        if(empty($this->appointmentData['appointment_comments'])) {
            $this->appointmentData['appointment_comments'] = 'Sin observaciones';
        }

        $appointment = Appointment::find($this->appointmentId)->update($this->appointmentData);

        session()->flash('appointment-message', 'Se actualizo la cita correctamente');

        $this->dispatch('show-success');
    }
}; ?>

<div x-data="{ showSuccessMessage: false}"
    x-on:show-success.window="showSuccessMessage = true; setTimeout(() => {showSuccessMessage = false; window.location.href='{{route('dashboard.agenda')}}'}, 3000)">
    @if($appointmentData === null)
    <div class=" p-6">
        <p class="uppercase text-red-700 font-semibold">El ID introducido es invalido</p>

        <button class="bg-red-600 text-white rounded px-5 py-3 mt-5">
            <a href="{{route('dashboard.agenda')}}">Regresar a agenda</a>
        </button>
    </div>
    @else
    <div class="p-6 pb-10 m-6 rounded bg-cyan-100">

        <div x-show="showSuccessMessage" x-transition:enter="transition ease-out duration-300"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-600 bg-opacity-60" style="display: none">
            <div class="bg-gradient-to-b from-[#41759D] to-[#0E2F5E] text-white px-8 py-4 rounded-lg w-1/3 h-1/3 flex
        justify-center items-center">
                <p class="text-3xl flex flex-col items-center gap-5 text-center">
                    <i class="fa-solid fa-circle-check text-7xl text-green-500"></i>
                    {{session('appointment-message')}}
                </p>
            </div>
        </div>

        <div class="flex gap-10">
            <div class="space-y-2 mb-5">
                <h2 class="text-lg text-[#174075] uppercase font-semibold">Nombre completo:</h2>
                <p class="text-base uppercase font-medium">
                    {{$patient->patient_name . ' ' . $patient->fathers_last_name . ' ' . $patient->mothers_last_name}}
                </p>
            </div>

            <div class="space-y-2 mb-5">
                <h2 class="text-lg text-[#174075] uppercase font-semibold">Doctor asignado:</h2>
                @if ($patient)
                <p class="text-base uppercase font-medium">
                    {{$patient->doctor}}
                </p>
                @endif
            </div>
        </div>

        <form wire:submit='updateAppointment' class="space-y-10">
            <div class="grid grid-cols-4 gap-10">
                <div class="flex flex-col gap-2">
                    <label class="text-xs text-[#41759D]" for="appointment_date">Fecha:</label>
                    <input wire:model='appointmentData.appointment_date' type="date"
                        class="rounded bg-[#89b4cc] border-none" name="appointment_date" id="appointment_date"
                        autocomplete="off">
                    @error('appointmentData.appointment_date')
                    <span class="text-red-600 mt-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs text-[#41759D]" for="appointment_time">Hora:</label>
                    <input wire:model='appointmentData.appointment_time' type="time"
                        class="rounded bg-[#89b4cc] border-none" name="appointment_time" id="appointment_time"
                        autocomplete="off">
                    @error('appointmentData.appointment_time')
                    <span class="text-red-600 mt-2">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs text-[#41759D]" for="appointment_type">Tipo de consulta:</label>
                    <select wire:model='appointmentData.appointment_type' class="rounded bg-[#89b4cc] border-none"
                        name="appointment_type" id="appointment_type">
                        <option value="">-- Selecciona una opción --</option>
                        <option value="1">Crónicos</option>
                        <option value="2">Sanos</option>
                        <option value="3">Laboratorio</option>
                        <option value="4">Odontología</option>
                    </select>
                    @error('appointmentData.appointment_type')
                    <span class="text-red-600 mt-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs text-[#41759D]" for="confirmed">Estatus:</label>
                    <select wire:model='appointmentData.confirmed' class="rounded bg-[#89b4cc] border-none"
                        name="confirmed" id="confirmed">
                        <option value="">-- Selecciona una opción --</option>
                        <option value="1">Confirmar</option>
                        <option value="0">Sin confirmar</option>
                    </select>
                    @error('appointmentData.confirmed')
                    <span class="text-red-600 mt-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-4 gap-10">
                <div class="col-span-3 flex flex-col gap-2">
                    <label class="uppercase text-xs" for="appointment_comments">Observaciones</label>
                    <textarea wire:model='appointmentData.appointment_comments' id="appointment_comments"
                        class="h-32"></textarea>
                </div>

                <div class="flex gap-3 flex-wrap">
                    <button type="submit" class="bg-[#41759D] place-self-center p-2 rounded-lg text-white">
                        Guardar Cita
                    </button>

                    <button class="bg-red-500 place-self-center p-2 rounded-lg text-white">
                        Eliminar Cita
                    </button>
                </div>
            </div>
        </form>
    </div>
    @endif

</div>