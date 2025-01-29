<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Services\CurpGenerator;

new 
 #[Layout('layouts.app')]
class extends Component {
    
    public $fullName;
    public $appointments;

    public function mount()
    {
        $this->fullName = auth()->user()->degree . ' ' . auth()->user()->name . ' ' .  auth()->user()->father_lastname . ' ' . auth()->user()->mother_lastname;

        $this->appointments = Appointment::whereDate('date', now()->format('Y-m-d'))->whereHas('patient', function ($query) {
            $query->where('clinic_id', auth()->user()->clinic_id);
        })->get();
    }
}; ?>

<section>
    @livewire('patient')

    <div class="flex">
        <div class="w-2/3 p-8">
            <div class="bg-[#41759D40] p-8 flex flex-col justify-center gap-3">
                <h2 class="text-3xl mb-2">
                    {{'¡Hola ' . $fullName . '!'}}
                </h2>
                
                <p class="text-xl">¿Qué quieres hacer hoy?</p>

                <div class="w-full flex justify-between mt-5">

                    <button x-data @click='$dispatch("open-modal", "patientModal")'
                        class="text-sm text-white bg-[#41759D] p-3 rounded-md">
                        Registro Paciente Nuevo
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>

                    <button x-data @click='$dispatch("open-modal", "appointmentModal")'
                        class="text-sm text-white bg-[#41759D] p-3 rounded-md">
                        Agendar Cita
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>

                    <a href="{{route('dashboard.agenda')}}" class="text-sm text-white bg-[#41759D] p-3 rounded-md">
                        Revisar Agenda
                        <i class="fa-solid fa-plus ml-2"></i>
                    </a>
                </div>
            </div>

            <div class="mt-10 border border-zinc-300 p-5">
                <div class="flex items-center">
                    <h3 class="font-semibold">Citas de hoy:</h3>
                    <span class="flex-grow text-center">{{now()->isoFormat('D [de] MMMM YYYY')}}</span>
                </div>

                <div class="grid grid-cols-5 gap-x-5 mt-3">
                    @forelse ($appointments as $appointment)
                    <div class="border border-zinc-300 flex flex-col items-center p-2">
                        <x-patient-initials :patient="$appointment->patient" />

                        <div class="mt-3 text-xs text-center space-y-2">
                            <p class="">
                                {{$appointment->patient->name . ' ' . $appointment->patient->father_last_name . ' '
                                . $appointment->patient->mother_last_name}}
                            </p>
                            <p class="">
                                {{Carbon::createFromFormat('H:i:s', $appointment->time)->format('g:i A')}}
                            </p>
                            @if ($appointment->confirmed === 0)
                            <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                            @else
                            <p class="bg-green-600 text-white p-1 rounded-full">Confirmada</p>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="col-span-5 text-center py-3">No hay citas para el día de hoy</p>
                    @endforelse
                </div>
            </div>
        </div>

        <section class="w-1/3 p-8">
            <h2 class="bg-[#0E2F5E] text-white text-center py-2 uppercase">Notificaciones</h2>
            <div class="h-80 overflow-y-scroll border">
                @forelse (auth()->user()->unreadNotifications as $notification)
                <p class="bg-[#174075] text-white text-center py-2">{{$notification->data['mensaje']}}</p>
                @empty
                <div class="w-full h-full flex justify-center items-center">
                    <p class="font-semibold text-lg">No hay notificaciones</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>
</section>
