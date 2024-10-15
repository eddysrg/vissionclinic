<?php

use Livewire\Volt\Component;
use App\Models\Patient;

new class extends Component {

    public $patient = [];
    public $queryElement = '';
    public $appointment_date = '';
    public $appointment_time = '';
    public $appointment_type = '';
    public $appointment_comments = '';
    public $patient_id = '';
    public $confirmed = '';


    public function onDateClick($date)
    {
        $this->dispatch('open-modal', 'scheduleModal');
    }

    public function cleanAppointmentForm()
    {
        $this->queryElement = '';
        // $this->appointmentData = [
        //     'appointment_date' => '',
        //     'appointment_time' => '',
        //     'appointment_type' => '',
        //     'appointment_comments' => '',
        //     'patient_id' => '',
        //     'confirmed' => ''
        // ];

        $this->resetErrorBag();

        // $this->dispatch('hidde-appointment');
    }

    public function showPatients()
    {
    }

    public function with()
    {
        return [
            'patients' => Patient::when($this->queryElement, function($query) {
                $query->where('patient_name', 'LIKE', '%' . $this->queryElement . '%')
                ->orWhere('fathers_last_name', 'LIKE', '%' . $this->queryElement . '%')
                ->orWhere('mothers_last_name', 'LIKE', '%' . $this->queryElement . '%')
                ->orWhere('id', 'LIKE', $this->queryElement)
                ->orWhereRaw('CONCAT(patient_name, " ", fathers_last_name) LIKE ?', ['%' . $this->queryElement . '%'])
                ->orWhereRaw('CONCAT(patient_name, " ", fathers_last_name, " ", mothers_last_name) LIKE ?', ['%' . $this->queryElement . '%']);
            })->limit(5)->get()
        ]; 
    }
}; ?>

<div>
    <div class="flex mt-10 gap-8">
        <div class="w-2/3">
            <div wire:ignore id="calendar"></div>
        </div>

        <div class="border border-zinc-300 h-fit">
            <h4 class="p-3">Detalles del día: <span class="font-semibold">15 de agosto</span></h4>

            <div class="bg-[#174075] p-3 text-white">
                <div class="flex items-center justify-between">
                    <p>Hora: <span>04:30 pm</span></p>
                    <button>
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
                <p>Paciente: <span>Diego Hernández Gómez</span></p>
                <p>Observaciones: <span>Se presenta por tercera vez en la semana</span></p>
                <div class="flex items-center justify-end">
                    <p class="px-5 py-2 bg-red-500 rounded">Sin confirmar</p>
                </div>
            </div>
        </div>
    </div>

    <x-calendar-modal name="scheduleModal" :show="false" maxWidth="lg">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Agendar Cita</h2>

            <form wire:submit='sendInfo' class="space-y-5">
                <div class="flex flex-wrap gap-8">
                    <div class="flex flex-col gap-2">
                        <label>Fecha:</label>
                        <input class="border border-zinc-300 rounded" type="date">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label>Hora:</label>
                        <input class="border border-zinc-300 rounded" type="time">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label>Médico:</label>
                        <select disabled class="border border-zinc-300 rounded" name="" id="">
                            <option value="DR IVAN GERARDO BALAM ABRAHAM">DR IVAN GERARDO BALAM ABRAHAM</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="">Tipo de consulta</label>
                        <select class="border border-zinc-300 rounded" name="" id="">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="1">Crónicos</option>
                            <option value="2">Sanos</option>
                            <option value="3">Planificación</option>
                            <option value="4">Enf. transmisibles</option>
                            <option value="5">Otras enfermedades</option>
                            <option value="6">Control de embarazo</option>
                            <option value="7">Control nutricional</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="">Estatus de la cita</label>
                        <select class="border border-zinc-300 rounded" name="" id="">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="0">Sin confirmar</option>
                            <option value="1">Confirmar</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="">Observaciones</label>
                    <textarea class="border border-zinc-300 rounded" name="" id=""></textarea>
                </div>

                <h2 class="text-lg font-medium text-gray-900">Buscar paciente</h2>

                <div class="flex gap-5">
                    <input wire:model.live.debounce.500ms='queryElement' autocomplete="off"
                        class="rounded-full border-zinc-300 w-full" type="text"
                        placeholder="No. Expediente | Nombre | Apellido P. | Apellido M.">
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
                                {{$patient->patient_name . ' ' . $patient->fathers_last_name . ' ' .
                                $patient->mothers_last_name}}
                            </p>
                        </div>

                        <p>
                            {{$patient->phone_number}}
                        </p>

                        {{-- <button wire:click='$dispatch("patientInfo", {patient: {{$patient}}})'
                            class="bg-[#41759D] aspect-square w-10 h-10 flex justify-center items-center rounded self-stretch">
                            <i class="fa-solid fa-plus text-white"></i>
                        </button> --}}

                        <button wire:click='showPatients'
                            class="bg-[#41759D] aspect-square w-10 h-10 flex justify-center items-center rounded self-stretch">
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </div>
                    @empty
                    <p class="text-center py-5 text-lg font-semibold">No hay registros</p>
                    @endforelse
                    @endif
                </div>
            </form>

            <button wire:click='cleanAppointmentForm' x-on:click="$dispatch('close-modal', 'scheduleModal')"
                class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </button>
        </div>
    </x-calendar-modal>

    @script
    <script>
        document.addEventListener('livewire:initialized', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    locale: 'es',
                    left: "prev,next today",
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: function(info) {
                    $wire.onDateClick(info);
                }

            });

            calendar.render();
        });
    </script>
    @endscript
</div>