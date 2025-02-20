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

<aside class="fixed bottom-0 w-full xl:top-0 left-0 z-20 xl:w-52 xl:h-full bg-[#174075] flex flex-col items-center gap-10 py-4">
{{-- <aside class="fixed w-full bottom-0 left-0 z-20 bg-red-200"> --}}

    <a href="{{route('dashboard')}}" class="mt-10 hidden xl:block">
        <picture>
            <source srcset="{{asset('images/ece_white_logo.webp')}}" type="image/webp">
            <img src="{{asset('images/ece_white_logo.png')}}" alt="Logo ece blanco">
        </picture>
    </a>

    @if(auth()->user()->profile_photo)
        <div class="px-10 hidden xl:block">
            <div class="aspect-square object-cover rounded-full overflow-hidden">
                <img src="{{asset('storage/' . auth()->user()->profile_photo)}}" alt="Profile photo">
            </div>

            <x-user-name classes='text-white mt-3 text-sm text-center' />
            <p class="mt-2 text-white text-center text-xs">600897456</p>
        </div>
    @else
        <div class="w-24 hidden xl:block">
            <img src="{{asset('images/imagen_perfil.svg')}}" alt="Profile photo">
        </div>
    @endif

    <nav>
        <ul class="xl:space-y-3 uppercase text-base xl:text-xs flex items-center xl:block">
            <li class="text-white">
                <i class="fa-solid fa-house mr-3"></i>
                <a href="{{route('dashboard')}}" class="hidden xl:inline-block">Inicio</a>
            </li>

            <li class="text-white">
                <i class="fa-solid fa-user-group mr-3"></i>
                <a href="{{route('dashboard.expedientes')}}" class="hidden xl:inline-block">Expedientes</a>
            </li>

            <li class="text-white">
                <i class="fa-solid fa-calendar-days mr-3"></i>
                <a href="{{route('dashboard.agenda')}}" class="hidden xl:inline-block">Agenda</a>
            </li>

            <li class=" text-white flex items-center">
                <i class="fa-solid fa-right-from-bracket mr-3"></i>
                <button wire:click='logout' class="uppercase hidden xl:inline-block">
                    Cerrar Sesión
                </button>
            </li>
        </ul>
    </nav>
</aside>