<?php

use Livewire\Volt\Component;
use App\Models\Appointment;


new class extends Component {
    protected $listeners = ['patientInfo', 'cleanAppointmentForm'];

    public $patient = [];
    public $appointmentStatus = null;
    public $appointmentData = [
        'appointment_date' => '',
        'appointment_time' => '',
        'appointment_type' => '',
        'appointment_comments' => '',
        'patient_id' => ''
    ];

    public function rules()
    {
        return [
            'appointmentData.appointment_date' => 'required|date', 
            'appointmentData.appointment_time' => 'required|date_format:H:i',
            'appointmentData.appointment_type' => 'required|in:1,2,3,4'
        ];
    }

    public function messages() {
        return [
            'appointmentData.appointment_type.required' => 'Seleccione alguno de los tipos de consulta'
        ];
    }

    public function cleanAppointmentForm()
    {
        $this->patient = [];
        $this->appointmentData = [
            'appointment_date' => '',
            'appointment_time' => '',
            'appointment_type' => '',
            'appointment_comments' => '',
            'patient_id' => ''
        ];

        $this->resetErrorBag();

        $this->dispatch('hidde-appointment');
    }

    public function patientInfo($patient) {
        $this->patient = $patient;
        $this->appointmentData['patient_id'] = $patient['id'];
        $this->dispatch('show-appointment');
    }

    public function createAppointment()
    {
        $this->validate();

        if(empty($this->appointmentData['appointment_comments'])) {
            $this->appointmentData['appointment_comments'] = 'Sin observaciones';
        }

        Appointment::create([
            'appointment_date' => $this->appointmentData['appointment_date'],
            'appointment_time' => $this->appointmentData['appointment_time'],
            'appointment_type' => $this->appointmentData['appointment_type'],
            'appointment_comments' => $this->appointmentData['appointment_comments'],
            'patient_id' => $this->appointmentData['patient_id']
        ]);

        session()->flash('appointment-message', 'Se agendó la cita correctamente');

        $this->dispatch('hidde-appointment');
        $this->dispatch('show-success');
        $this->cleanAppointmentForm();

    }
}; ?>

<div x-data="{ showSuccessMessage: false}"
    x-on:show-success.window="showSuccessMessage = true; setTimeout(() => showSuccessMessage = false, 3000); setTimeout(() => window.location.reload(), 1000)">

    <div x-show="showSuccessMessage" x-transition:enter="transition ease-out duration-300"
        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-600 bg-opacity-60">
        <div class="bg-gradient-to-b from-[#41759D] to-[#0E2F5E] text-white px-8 py-4 rounded-lg w-1/3 h-1/3 flex
        justify-center items-center">
            <p class="text-3xl flex flex-col items-center gap-5">
                <i class="fa-solid fa-circle-check text-7xl text-green-500"></i>
                {{session('appointment-message')}}
            </p>
        </div>
    </div>

    <div x-show="showAppointment" x-on:show-appointment.window="showAppointment = true"
        x-on:hidde-appointment.window="showAppointment = false" class="p-6 pb-10 m-6 rounded bg-cyan-100">

        <div class="flex gap-10">
            <div class="space-y-2 mb-5">
                <h2 class="text-lg text-[#174075] uppercase font-semibold">Nombre completo:</h2>
                @if ($patient)
                <p class="text-base uppercase font-medium">{{$this->patient['patient_name'] . ' ' .
                    $this->patient['fathers_last_name'] . ' ' . $this->patient['mothers_last_name']}}</p>
                @endif
            </div>

            <div class="space-y-2 mb-5">
                <h2 class="text-lg text-[#174075] uppercase font-semibold">Doctor asignado:</h2>
                @if ($patient)
                <p class="text-base uppercase font-medium">
                    {{$this->patient['doctor']}}
                </p>
                @endif
            </div>
        </div>

        <form wire:submit='createAppointment' class="space-y-10">
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
            </div>

            <div class="grid grid-cols-4 gap-10">
                <div class="col-span-3 flex flex-col gap-2">
                    <label class="uppercase text-xs" for="appointment_comments">Observaciones</label>
                    <textarea wire:model='appointmentData.appointment_comments' id="appointment_comments"
                        class="h-32"></textarea>
                </div>

                <button type="submit"
                    class="{{is_null($appointmentStatus) ? 'bg-amber-500' : ($appointmentStatus ? 'bg-green-500' : 'bg-red-500')}} place-self-center px-8 py-3 rounded-lg text-white">Confirmar
                    Cita</button>
            </div>
        </form>
    </div>
</div>