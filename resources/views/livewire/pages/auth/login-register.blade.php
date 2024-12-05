<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\LoginForm;

new class extends Component {
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended('register');
    }

}; ?>

<form wire:submit="login">
    <!-- Name -->
    <div>
        <x-input-label for="username" :value="__('Usuario')" class="text-white" />
        <x-text-input wire:model="form.username" id="username" class="block mt-1 w-full" type="text" name="username"
            autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('form.username')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Contraseña')" class="text-white" />

        <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password" name="password"
            autocomplete="current-password" />

        <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-10">
        <x-login-button>
            {{ __('Log in') }}
        </x-login-button>
    </div>

</form>