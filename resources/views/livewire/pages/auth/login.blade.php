<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div
    class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-[#ffffff] via-[#0e58c4] via-63% to-[#090a14] to-76%">

    <h1 class="text-5xl uppercase text-[#070C3D]">Expediente Clínico Electrónico</h1>

    <div
        class="grid w-full sm:max-w-md mt-6 px-6 py-4 bg-gradient-to-b from-[#0D418F] to-[#041329] shadow-md overflow-hidden sm:rounded-lg">

        <div class="flex justify-center items-center gap-3 pt-8">
            <img src="{{asset('images/login_icono.svg')}}" alt="Login VCL icono">
            <h2 class="text-3xl text-white font-normal">Bienvenido</h2>
        </div>

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form wire:submit="login">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Usuario')" class="text-white" />
                    <x-text-input wire:model="form.name" id="name" class="block mt-1 w-full" type="text" name="name"
                        autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
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

        <div class="w-32 py-5 flex justify-self-end">
            <img src="{{asset('images/ece_white_logo.png')}}" alt="ECE logo">
        </div>
    </div>

    <div class="mt-10 text-center text-white">
        <p>® GDC DataComm | 2024</p>
        <p>Este sitio está diseñado para ser utilizado con el navegador Google Chrome o Mozilla Firefox</p>
    </div>
</div>