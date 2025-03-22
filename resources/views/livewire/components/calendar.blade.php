<?php

use Livewire\Volt\Component;
use App\Models\Patient;
use App\Models\Appointment;
use Carbon\Carbon;

new class extends Component {

    // public $appointmentEvents = [];
    // public $appointments;


    public function onDateClick($info)
    {
        $this->dispatch('open-modal', 'appointmentModal');
        $this->dispatch('setDateValues', dateInfo: $info);
    }

    public function loadEvents()
    {
        $appointments = Appointment::whereHas('patient', function($query) {
            $query->where('medical_unit_id', auth()->user()->medical_unit_id);
        })->get();

        return $appointments->map(function ($appointment) {

            // dd(Appointment::find(1)->date->format('Y-m-d'));
        // dd(Appointment::find(1)->time->format('H:i:s'));

            $title = $appointment->patient->full_name;

            $start = $appointment->date->format('Y-m-d') . 'T' . $appointment->time->format('H:i:s');

            $formattedTime = $appointment->time->format('g:i A');

            return [
                'id' => $appointment->id,
                'title' => $title,
                'start' => $start,
            ];
        })->toArray();
    }

    public function deleteAppointment($id)
    {
        Appointment::find($id)->delete();
        $this->dispatch('show-notification', message: 'Cita eliminada con éxito');
    }

    public function with()
    {
        return [
            'appointmentEvents' => $this->loadEvents(),
            'appointments' => Appointment::whereDate('date', Carbon::now())->whereHas('patient', function($query) {
                $query->where('medical_unit_id', auth()->user()->medical_unit_id);
            })->get(),
        ];
    }
    
}; ?>

<div>
    <x-notification />

    @livewire('components.appointment')

    <main class="grid grid-cols-[1.8fr_.8fr] mt-10 gap-8">
        <section>
            <div wire:ignore id="calendar"></div>
        </section>

        <section class="border border-zinc-300 h-96 overflow-y-scroll">
            <h4 class="p-3 border-b border-zinc-300">
                Detalles del día: 
                <span class="font-semibold">
                    {{now()->isoFormat('D [de] MMMM YYYY')}}
                </span>
            </h4>

            @forelse ($appointments as $appointment)

            @php
            $fullName = $appointment->patient->full_name;

            $formattedTime = $appointment->time->format('g:i A');
            @endphp

            <div class="bg-[#174075] p-3 text-white border-b">
                <div class="flex items-center justify-between">
                    <p>Hora: {{$formattedTime}}</p>
                    <button wire:click='deleteAppointment({{$appointment->id}})'
                        wire:confirm='¿Desea eliminar esta cita?'>
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>

                <p>Paciente:
                    {{$fullName}}
                </p>

                <p>Observaciones: {{$appointment->comments}}</p>

                <div class="flex items-center justify-end mt-5">
                    <p @class([ 'px-5' , 'py-2' , 'bg-green-500'=> $appointment->status === 'confirm',
                        'bg-red-500' => $appointment->status === 'unconfirm',
                        'rounded',
                        ])>{{$appointment->status === 'confirm' ? 'Confirmado' : 'Sin confirmar'}}</p>
                </div>
            </div>
            @empty
            <div class="w-full h-full flex justify-center items-center">
                <p class="text-center font-semibold">No hay citas para el día de hoy</p>
            </div>
            @endforelse
        </section>
    </main>

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
                contentHeight: 'auto',
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
                    var clickedDate = new Date(info.date);
                    var now = new Date();

                    if(info.view.type == 'timeGridWeek' || info.view.type == 'timeGridDay') {
                        if(!(clickedDate.getUTCHours() > now.getHours())) {
                            alert('No se puede elegir una hora anterior a la actual');
                            return
                        }
                    }
                    $wire.onDateClick(info);
                },
                events: @json($appointmentEvents),
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },
                eventColor: 'white',
                eventDisplay: 'block',
                eventTextColor: 'black',
                eventClick: function(info) {
                    @this.dispatch('setAppointmentData', { id: info.event.id });
                    // console.log(info);
                },
                eventMouseEnter: function(info) {
                    info.el.style.cursor = 'pointer';
                }
            });
            calendar.render();
        });

    </script>
    @endscript
</div>