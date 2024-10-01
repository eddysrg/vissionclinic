<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<aside class="w-72 h-5/6 bg-[#174075] flex flex-col items-center justify-evenly">
    <div class="w-52">
        <img src="{{asset('images/ece_white_logo.png')}}" alt="Logo ece blanco">
    </div>

    <div class="w-28">
        <img src="{{asset('images/imagen_perfil.svg')}}" alt="Profile photo">
    </div>

    <nav>
        <ul class="space-y-5 uppercase text-sm">
            <li class="text-white">
                <i class="fa-solid fa-house mr-3"></i>
                <a href="{{route('dashboard')}}">Inicio</a>
            </li>
            <li class="text-white">
                <i class="fa-solid fa-user-group mr-3"></i>
                <a href="{{route('dashboard.expedientes')}}">Expedientes</a>
            </li>
            <li class="text-white">
                <i class="fa-solid fa-calendar-days mr-3"></i>
                Agenda
            </li>

            <li class="text-white flex items-center">
                <i class="fa-solid fa-right-from-bracket mr-3"></i>
                <button wire:click='logout' class="uppercase">
                    Cerrar Sesión
                </button>
            </li>

        </ul>
    </nav>
</aside>