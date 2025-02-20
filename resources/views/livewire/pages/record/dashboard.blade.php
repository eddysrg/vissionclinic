<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\Appointment;
use Carbon\Carbon;
use App\Services\CurpGenerator;

new 
#[Layout('layouts.app')]
#[Title('Dashboard - Vission Clinic ECE')]
class extends Component {
    
    public $todaysDate;
    public $date;
    public $currentUser;
    public $fullName;
    public $appointments;
    public $notifications;
    public $user;
    public $currentDate;

    public function mount()
    {
        $this->user = Auth::user();
        $this->todaysDate = Carbon::now()->isoFormat('D [de] MMMM YYYY');
        $this->date = Carbon::now()->format('Y-m-d');
        $this->currentUser = Auth::user();
        $this->fullName = $this->currentUser->degree . ' ' . $this->currentUser->name . ' ' . $this->currentUser->father_lastname . ' ' . $this->currentUser->mother_lastname;
        $this->currentDate = Carbon::today();
        $this->appointments = Appointment::whereDate('date', Carbon::now()->format('Y-m-d'))->whereHas('patient', function ($query) {
            $query->where('clinic_id', auth()->user()->clinic_id);
        })->get();
        $this->notifications = $this->user->notifications()
        ->whereDate('created_at', $this->currentDate)
        ->get();
    }

}; ?>

<main>

    @livewire('components.patient')

    @livewire('components.appointment')

    <x-notification />

    <div class="xl:flex">
        <div class="xl:w-2/3 xl:h-screen p-8">
            <div class="bg-[#41759D40] p-5 h-2/5 flex flex-col justify-center gap-3">
                <h2 class="text-2xl text-center mb-2">
                    {{'¡Hola ' . $fullName . '!'}}
                </h2>

                <p class="text-2xl text-center">¿Qué quieres hacer hoy?</p>

                <div class="mt-9 w-full flex flex-col xl:flex-row xl:justify-evenly gap-10">

                    <button x-data @click='$dispatch("open-modal", "patientModal")'
                        class="text-base text-white bg-[#41759D] p-3 rounded-md">
                        Registro Paciente Nuevo
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>

                    <button x-data @click='$dispatch("open-modal", "appointmentModal")'
                        class="text-base text-white bg-[#41759D] p-3 rounded-md">
                        Agendar Cita
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>

                    <a href="{{route('dashboard.agenda')}}" class="text-base text-white text-center  bg-[#41759D] p-3 rounded-md">
                        Revisar Agenda
                        <i class="fa-solid fa-plus ml-2"></i>
                    </a>
                </div>
            </div>

            <div class="mt-10 border border-zinc-300 p-5 h-2/5">
                <h3 class="text-xl flex">Citas de hoy: <span
                        class="font-semibold flex-grow text-center">{{$todaysDate}}</span>
                </h3>

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

        <section class="xl:w-1/3 p-8">
            <h2 class="bg-[#0E2F5E] text-white text-center py-2 uppercase">Notificaciones</h2>
            <div class="h-80 overflow-y-scroll border">
                @forelse ($notifications as $notification)
                <p class="bg-[#174075] text-white text-center py-2">{{$notification->data['mensaje']}}</p>
                @empty
                <div class="w-full h-full flex justify-center items-center">
                    <p class="font-semibold text-lg">No hay notificaciones</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>
</main>
