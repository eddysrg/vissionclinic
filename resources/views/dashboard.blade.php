@php
use Carbon\Carbon;
$todaysDate = Carbon::now()->isoFormat('D [de] MMMM YYYY');
$date = Carbon::now()->format('Y-m-d');
@endphp

<x-app-layout>
    <x-slot name="meta">
        <title>Vission Clinic ECE Dashboard</title>
        <meta name="description" content="">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="robots" content="index,follow">
    </x-slot>

    <livewire:patient />
    @livewire('appointment')

    <x-notification />

    <div class="flex">
        <div class="w-2/3 p-8">
            <div class="bg-[#41759D40] p-5">
                <h2 class="text-4xl mb-2">¡Hola {{Auth::user()->name}}!</h2>
                <p class="text-xl">¿Qué quieres hacer hoy?</p>

                <div class="mt-9 w-full flex justify-center gap-10">

                    <button x-data @click='$dispatch("open-modal", "patientModal")'
                        class="text-xs text-white bg-[#41759D] p-3 rounded-md">
                        Registro Paciente Nuevo
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>


                    <button x-data @click='$dispatch("open-modal", "appointmentModal")'
                        class="text-xs text-white bg-[#41759D] p-3 rounded-md">
                        Agendar Cita
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>

                    <a href="{{route('dashboard.agenda')}}" class="text-xs text-white bg-[#41759D] p-3 rounded-md">
                        Revisar Agenda
                        <i class="fa-solid fa-plus ml-2"></i>
                    </a>
                </div>
            </div>

            <div class="mt-10 border border-zinc-300 p-5">
                <h3>Citas de hoy: <span class="font-semibold">{{$todaysDate}}</span></h3>

                <div class="grid grid-cols-5 gap-x-5 mt-3">
                    @forelse ($appointments as $appointment)
                    <div class="border border-zinc-300 flex flex-col items-center p-2">
                        @php
                        $firstLetter = substr($appointment->patient->name, 0, 1);
                        $secondLetter = substr($appointment->patient->father_last_name, 0, 1);
                        @endphp

                        <p class="
                            
                            {{$appointment->patient->gender === 'male' ? 'bg-[#174075] text-white' : 'bg-[#41759D40] text-[#41759D]'}}
                            text-2xl 
                            font-medium
                            w-fit 
                            aspect-square 
                            px-2 
                            py-2 
                            rounded-full 
                            flex 
                            items-center ">
                            {{$firstLetter . $secondLetter}}
                        </p>

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

                @forelse (auth()->user()->notifications as $notification)
                <p class="bg-[#174075] text-white text-center py-2">{{$notification->data['mensaje']}}</p>
                @empty
                <div class="w-full h-full flex justify-center items-center">
                    <p class="font-semibold text-lg">No hay notificaciones</p>
                </div>
                @endforelse

                {{-- <p class="text-[#0E2F5E] text-center py-2">Paciente nuevo agregado</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
                <p class="text-[#0E2F5E] text-center py-2">Videoconsulta 6:30 pm</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
                <p class="text-[#0E2F5E] text-center py-2">Paciente nuevo agregado</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p> --}}


            </div>

        </section>


    </div>
</x-app-layout>