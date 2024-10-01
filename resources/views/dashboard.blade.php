@php
use Carbon\Carbon;
$fechaHoy = Carbon::now()->isoFormat('D [de] MMMM YYYY');
@endphp

<x-app-layout>
    <div class="flex">
        <div class="w-2/3 p-8">
            <div class="bg-[#41759D40] p-5">
                <h2 class="text-2xl">¡Hola {{Auth::user()->name}}!</h2>
                <p>¿Qué quieres hacer hoy?</p>

                <div class="mt-8 w-full flex justify-evenly">
                    <livewire:patient />

                    <a href="{{route('dashboard.cita')}}" class="text-xs text-white bg-[#41759D] p-3 rounded-md">
                        Agendar Cita
                        <i class="fa-solid fa-plus ml-2"></i>
                    </a>

                    <button class="text-xs text-white bg-[#41759D] p-3 rounded-md">
                        Revisar Agenda
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>
                </div>
            </div>

            <div class="mt-10 border border-zinc-300 p-5">
                <h3>Citas de hoy: <span class="font-semibold">{{$fechaHoy}}</span></h3>

                <div class="grid grid-cols-5 gap-x-5 mt-3">
                    <div class="border border-zinc-300 flex flex-col items-center p-2">
                        <p
                            class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                            DH
                        </p>

                        <div class="mt-3 text-xs text-center space-y-2">
                            <p class="">Diego Hernandez</p>
                            <p class="">2:30 pm</p>
                            <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                        </div>
                    </div>

                    <div class="border border-zinc-300 flex flex-col items-center p-2">
                        <p
                            class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                            DH
                        </p>

                        <div class="mt-3 text-xs text-center space-y-2">
                            <p class="">Diego Hernandez</p>
                            <p class="">2:30 pm</p>
                            <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                        </div>
                    </div>

                    <div class="border border-zinc-300 flex flex-col items-center p-2">
                        <p
                            class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                            DH
                        </p>

                        <div class="mt-3 text-xs text-center space-y-2">
                            <p class="">Diego Hernandez</p>
                            <p class="">2:30 pm</p>
                            <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                        </div>
                    </div>

                    <div class="border border-zinc-300 flex flex-col items-center p-2">
                        <p
                            class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                            DH
                        </p>

                        <div class="mt-3 text-xs text-center space-y-2">
                            <p class="">Diego Hernandez</p>
                            <p class="">2:30 pm</p>
                            <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                        </div>
                    </div>

                    <div class="border border-zinc-300 flex flex-col items-center p-2">
                        <p
                            class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                            DH
                        </p>

                        <div class="mt-3 text-xs text-center space-y-2">
                            <p class="">Diego Hernandez</p>
                            <p class="">2:30 pm</p>
                            <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="w-1/3 p-8">
            <p class="bg-[#0E2F5E] text-white text-center py-2 uppercase">Notificaciones</p>
            <p class="text-[#0E2F5E] text-center py-2">Paciente nuevo agregado</p>
            <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
            <p class="text-[#0E2F5E] text-center py-2">Videoconsulta 6:30 pm</p>
            <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
            <p class="text-[#0E2F5E] text-center py-2">Paciente nuevo agregado</p>
            <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
        </div>
    </div>
</x-app-layout>