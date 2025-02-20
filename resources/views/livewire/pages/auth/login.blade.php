<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public $isLoading = false;

    // $this->dispatch('load-spinner');


    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->isLoading = true;

        $this->validate();

        try {
            $this->form->authenticate();
            Session::regenerate();
            $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
        } catch (\Exception $e) {
            $this->isLoading = false;
            throw $e;
        }

        
    }
}; ?>

<div
    class="
    min-h-screen 
    flex 
    flex-col 
    sm:justify-center 
    items-center 
    pt-6 
    sm:pt-0 
    bg-gradient-to-b 
    from-[#ffffff] 
    via-[#0e58c4] 
    via-63% 
    to-[#090a14] 
    to-76% 
    relative">

    <div wire:loading>
        <span id="spinner" class="spinner bg-gray-600 absolute inset-0 opacity-85 flex justify-center items-center">
            <div>
                <i class="fa-solid fa-spinner fa-spin text-6xl text-[#0D418F]"></i>
            </div>
        </span>
    </div>

    

    <h1 class="text-2xl text-center xl:text-5xl uppercase text-[#070C3D] mt-10 md:mt-0">Expediente Clínico Electrónico</h1>

    <div
        class="grid w-full sm:max-w-md mt-6 px-6 py-4 md:bg-gradient-to-b md:from-[#0D418F] md:to-[#041329] md:shadow-md md:overflow-hidden sm:rounded-lg">

        <div class="flex justify-center items-center gap-3 pt-8">
            <i class="fa-solid fa-user text-4xl text-gray-500"></i>
            <h2 class="text-3xl text-white font-normal">Bienvenido</h2>
        </div>

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- <form> --}}
            <form wire:submit="login">
                <!-- Name -->
                <div>
                    <x-input-label for="username" :value="__('Usuario')" class="text-white" />
                    <x-text-input wire:model="form.username" id="username" class="block mt-1 w-full" type="text"
                        name="username" autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.username')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-white" />

                    <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                        name="password" autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-10">
                    <x-login-button>
                        {{ __('Log in') }}
                    </x-login-button>
                </div>
            </form>
        </div>

        <div class="w-32 py-5 flex mx-auto md:mx-0 md:justify-self-end">
            <picture>
                <source srcset="{{asset('images/ece_white_logo.webp')}}" type="image/webp">
                <img src="{{asset('images/ece_white_logo.png')}}" alt="ECE logo" class="w-full">
            </picture>
        </div>
    </div>

    <div class="md:mt-10 text-center text-white">
        <p class="text-sm md:text-lg">® GDC DataComm | 2024</p>
        <p class="text-sm md:text-lg">Este sitio está diseñado para ser utilizado con el navegador Google Chrome o Mozilla Firefox</p>
    </div>
</div>