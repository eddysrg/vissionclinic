<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\{Appointment, MedicalUnit, Patient};
use Carbon\Carbon;
use App\Services\CurpGenerator;

new
#[Layout('layouts.app')]
#[Title('Dashboard - Vission Clinic ECE')]
class extends Component {

    public $user;
    public $appointments = [];

    public function mount()
    {
        $this->user = Auth::user();

        $this->appointments = Appointment::whereHas('patient', function ($query) {
            $query->where('medical_unit_id', $this->user->medical_unit_id);
        })->get();
    }

}; ?>

<div class="dbc-main">
    <div class="dbc-main__grid-container">
        <div class="dbc-main__section">
            <h2 class="dbc-main__section-title">¡Hola Dr. Luis Flores!</h2>
            <p class="dbc-main__section-subtitle">¿Qué quieres hacer hoy?</p>
            <div class="dbc-main__btns-container">
                <button class="btn">Registro de paciente nuevo<i class="ri-add-line"></i></button>
                <button class="btn">Agendar Cita<i class="ri-add-line"></i></button>
                <button class="btn">Revisar Agenda<i class="ri-add-line"></i></button>
            </div>
        </div>
        <div class="dbc-main__section">
            <h2 class="dbc-main__section-title--notifications">Notificaciones</h2>
        </div>
        <div class="dbc-main__section">
            <h2 class="dbc-main__section-title--appointments">Citas de hoy: {{now()->format('d/m/y')}}</h2>

            <div class="dbc-main__appointments-grid-container">
                <div class="dbc-main__appointment">
                    <div class="dbc-main__appointment-initials">DH</div>
                    <h4 class="dbc-main__appointment-name">Diego Hernandez</h4>
                    <p class="dbc-main__appointment-time">2:30 pm</p>
                    <p class="dbc-main__appointment-status">Sin Confirmar</p>
                </div>
                <div class="dbc-main__appointment">
                    <div class="dbc-main__appointment-initials">DH</div>
                    <h4 class="dbc-main__appointment-name">Diego Hernandez</h4>
                    <p class="dbc-main__appointment-time">2:30 pm</p>
                    <p class="dbc-main__appointment-status">Sin Confirmar</p>
                </div>
                <div class="dbc-main__appointment">
                    <div class="dbc-main__appointment-initials">DH</div>
                    <h4 class="dbc-main__appointment-name">Diego Hernandez</h4>
                    <p class="dbc-main__appointment-time">2:30 pm</p>
                    <p class="dbc-main__appointment-status">Sin Confirmar</p>
                </div>
                <div class="dbc-main__appointment">
                    <div class="dbc-main__appointment-initials">DH</div>
                    <h4 class="dbc-main__appointment-name">Diego Hernandez</h4>
                    <p class="dbc-main__appointment-time">2:30 pm</p>
                    <p class="dbc-main__appointment-status">Sin Confirmar</p>
                </div>
            </div>
        </div>
    </div>

    @livewire('components.patient')

    @livewire('components.appointment')

    <x-notification />

    {{-- <div class="xl:flex">
        <div class="xl:w-2/3 xl:h-screen p-8">
            <div class="bg-[#41759D40] p-5 h-2/5 flex flex-col justify-center gap-3">
                <h2 class="text-4xl mb-2">
                    {{'¡Hola ' . $user->full_name . '!'}}
                </h2>

                <p class="text-3xl">¿Qué quieres hacer hoy?</p>

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
                        class="font-semibold flex-grow text-center">{{now()->isoFormat('D [de] MMMM YYYY')}}</span>
                </h3>

                <div class="grid grid-cols-5 gap-5 mt-5">
                    @forelse ($appointments as $appointment)
                        <div class="border border-zinc-300 flex flex-col items-center p-2">
                            <x-patient-initials :patient="$appointment->patient" />

                            <div class="mt-3 text-xs text-center space-y-2">
                                <p>
                                    {{$appointment->patient->full_name}}
                                </p>

                                <p>
                                    {{$appointment->time->format('g:i A')}}
                                </p>

                                <p class="{{$appointment->status === 'confirm' ? 'bg-green-600' : 'bg-red-600'}} text-white p-1 rounded-full">
                                    {{$appointment->status === 'confirm' ? 'Confirmada' : 'Sin confirmar'}}
                                </p>
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
                @forelse ($user->notifications as $notification)
                    <p class="bg-[#174075] text-white text-center py-2">{{$notification->data['mensaje']}}</p>
                @empty
                    <div class="w-full h-full flex justify-center items-center">
                        <p class="font-semibold text-lg">No hay notificaciones</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div> --}}
</div>
