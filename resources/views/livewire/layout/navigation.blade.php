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

<aside class="fixed top-0 left-0 z-20 w-52 h-full bg-[#174075] flex flex-col items-center justify-evenly">
    <div class="w-36">
        <picture>
            <source srcset="{{asset('images/ece_white_logo.webp')}}" type="image/webp">
            <img src="{{asset('images/ece_white_logo.png')}}" alt="Logo ece blanco">
        </picture>
    </div>

    @if(auth()->user()->profile_photo)
    <div class="w-16 h-16 object-cover rounded-full overflow-hidden">
        <img src="{{asset('storage/' . auth()->user()->profile_photo)}}" alt="Profile photo">
    </div>
    @else
    <div class="w-16">
        <img src="{{asset('images/imagen_perfil.svg')}}" alt="Profile photo">
    </div>
    @endif



    <nav>
        <ul class="space-y-5 uppercase text-xs">
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
                <a href="{{route('dashboard.agenda')}}">Agenda</a>
            </li>

            <li class=" text-white flex items-center">
                <i class="fa-solid fa-right-from-bracket mr-3"></i>
                <button wire:click='logout' class="uppercase">
                    Cerrar Sesión
                </button>
            </li>
        </ul>
    </nav>
</aside>