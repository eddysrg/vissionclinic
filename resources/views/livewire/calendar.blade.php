<?php

use Livewire\Volt\Component;
use App\Models\Patient;
use App\Models\Appointment;
use Carbon\Carbon;

new class extends Component {

    public $patient = [];
    public $makingAppointment = false;
    public $queryElement = '';

    public $appointment_date = '';
    public $appointment_time = '';
    public $appointment_type = '';
    public $appointment_comments = '';
    public $patient_id = '';
    public $confirmed = '';


    public function onDateClick($date)
    {
        // dd($typeDate);
        // dd(Carbon::parse($date['date'])->format('H:i'));
        // dd(Carbon::parse($date['date'])->format('Y-m-d'));
        // dd($date);
        $typeDate = $date['view']['type'];


        switch ($typeDate) {
            case 'dayGridMonth':
                $this->appointment_date = Carbon::parse($date['date'])->format('Y-m-d');
                break;

            case 'timeGridWeek';
            case 'timeGridDay':
                $this->appointment_time = Carbon::parse($date['date'])->format('H:i');
                $this->appointment_date = Carbon::parse($date['date'])->format('Y-m-d');
                break;
            default:
                break;
        }

        $this->dispatch('open-modal', 'scheduleModal');

    }

    public function createSchedule()
    {
        $this->validate([
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required', 'date_format:H:i'],
            'appointment_type' => ['required', 'in:1,2,3,4,5,6,7'],
            'confirmed' => ['required', 'in:0,1']
        ]);

        if(empty($this->appointment_comments)) {
            $this->appointment_comments = 'Sin observaciones';
        }

        Appointment::create([
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'appointment_type' => $this->appointment_type,
            'appointment_comments' => $this->appointment_comments,
            'patient_id' => $this->patient_id,
            'confirmed' => $this->confirmed
        ]);

        $this->dispatch('close-modal', 'scheduleModal');
        $this->cleanAppointmentForm();
        session()->flash('scheduleMessage', 'Cita creada con éxito');
        $this->dispatch('show-notification');
    }

    public function cleanAppointmentForm()
    {
        $this->queryElement = '';
        $this->appointment_date = '';
        $this->appointment_time = '';
        $this->appointment_type = '';
        $this->appointment_comments = '';
        $this->patient_id = '';
        $this->confirmed = '';
        $this->resetErrorBag();
        // $this->dispatch('hidde-appointment');
    }

    public function makeAppointment($patient)
    {
        $this->makingAppointment = true;
        $this->patient = $patient;
        $this->patient_id = $patient['id'];
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

    <div x-data="{showNotification: false}"
        x-on:show-notification.window="showNotification = true; setTimeout(() => showNotification = false, 2000);">

        <div x-show='showNotification' x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="fixed rounded flex gap-4 justify-center items-center top-14 right-2 w-72 h-40 bg-green-500 z-50"
            style="display: none">
            <i
                class="fa-solid fa-bell text-xl text-white bg-green-600 aspect-square w-10 h-10 flex items-center justify-center rounded-full"></i>
            <p class="text-xl text-white">{{session('scheduleMessage')}}</p>
        </div>
    </div>




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
            <div class="flex justify-end">
                <button wire:click='cleanAppointmentForm'
                    x-on:click="$dispatch('close-modal', 'scheduleModal') ; open = true">
                    <i class="fa-solid fa-rectangle-xmark text-red-500 text-4xl"></i>
                </button>
            </div>

            <div x-show='open'>
                <h2 class="text-lg font-medium text-gray-900 mb-5">Buscar paciente</h2>
                <form wire:submit='with'>
                    <div class="flex gap-5">
                        <input wire:model='queryElement' type="search" autocomplete="off"
                            class="rounded-full border-zinc-300 w-2/3" type="text"
                            placeholder="No. Expediente | Nombre | Apellido P. | Apellido M.">
                        <button
                            class="bg-[#41759D] place-self-center px-8 py-2 rounded-lg text-white flex items-center gap-2">
                            Buscar
                        </button>
                    </div>
                </form>

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

                        <button @click="open = !open" wire:click='makeAppointment({{$patient}})'
                            class="bg-[#41759D] aspect-square w-10 h-10 flex justify-center items-center rounded self-stretch">
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </div>
                    @empty
                    <p class="text-center py-5 text-lg font-semibold">No hay registros</p>
                    @endforelse
                    @endif
                </div>
            </div>

            <div x-show='!open'>
                <h2 class="text-lg font-medium text-gray-900 mb-6">Agendar Cita</h2>

                @if ($patient)
                <div class="flex gap-5 mb-10">
                    <div>
                        <p>Nombre Completo:</p>
                        <p class="uppercase">
                            {{$patient['patient_name'] . ' ' .
                            $patient['fathers_last_name'] . ' ' . $patient['mothers_last_name']}}
                        </p>
                    </div>

                    <div>
                        <p>Médico:</p>
                        <p class="uppercase">{{$patient['doctor']}}</p>
                    </div>

                </div>
                @endif



                <form wire:submit='createSchedule' class="space-y-5">
                    <div class="flex flex-wrap gap-8">
                        <div class="flex flex-col gap-2">
                            <label>Fecha:</label>
                            <input wire:model='appointment_date' class="border border-zinc-300 rounded" type="date">
                            @error('appointment_date')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label>Hora:</label>
                            <input wire:model='appointment_time' class="border border-zinc-300 rounded" type="time">
                            @error('appointment_time')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label>Médico:</label>
                            <select disabled class="border border-zinc-300 rounded" name="" id="">
                                <option value="DR IVAN GERARDO BALAM ABRAHAM">DR IVAN GERARDO BALAM ABRAHAM</option>
                            </select>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="">Tipo de consulta</label>
                            <select wire:model='appointment_type' class="border border-zinc-300 rounded" name="" id="">
                                <option value="">-- Selecciona una opción --</option>
                                <option value="1">Crónicos</option>
                                <option value="2">Sanos</option>
                                <option value="3">Planificación</option>
                                <option value="4">Enf. transmisibles</option>
                                <option value="5">Otras enfermedades</option>
                                <option value="6">Control de embarazo</option>
                                <option value="7">Control nutricional</option>
                            </select>
                            @error('appointment_type')
                            <span class="text-red-600 mt-2">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="">Estatus de la cita</label>
                            <select wire:model='confirmed' class="border border-zinc-300 rounded" name="" id="">
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
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="">Observaciones</label>
                        <textarea wire:model='appointment_comments' class="border border-zinc-300 rounded" name=""
                            id=""></textarea>
                    </div>


                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Crear cita
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </x-calendar-modal>

    @script
    <script>
        document.addEventListener('livewire:initialized', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista'
                },
                timeZone: 'CST',
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: "prev,next today",
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                validRange: function(nowDate) {
                    return {
                        start: nowDate,
                    }
                },
                dateClick: function(info) {
                    // $wire.onDateClick(info);
                    var clickedDate = info.date;
                    var now = new Date();

                    console.log(clickedDate, now);
                },
            });

            calendar.render();
        });
    </script>
    @endscript
</div>