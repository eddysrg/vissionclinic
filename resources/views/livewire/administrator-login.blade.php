<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;

new 
#[Layout('layouts.administrator_login')]
class extends Component {
    
    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }

    public function login()
    {
        $this->validate();
        
        dd("Hola raza");

        // $this->form->authenticate();

        // Session::regenerate();

        // $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<main class="h-screen">
    <div class="h-full grid grid-cols-2">
        <section class="bg-[#003f8c] p-10">
            <div>
                <picture>
                    <source srcset="{{asset('images/vcl_white_logo.webp')}}" type="image/webp">
                    <img src="{{asset('images/vcl_white_logo.png')}}" alt="VCL logo">
                </picture>
            </div>

            <h1 class="text-white text-2xl text-right mt-20">¡Bienvenido al administrador de usuarios de VissionClinic!</h1>

            <span class="block text-center mt-20">
                <i class="fa-solid fa-users-gear text-8xl text-white"></i>
            </span>

        </section>
        
        <section>
            <div class="p-20">
                <form wire:submit='login'>
                    <fieldset class="space-y-6">
                        <legend class="font-semibold text-2xl text-center">Ingresa a tu cuenta</legend>
            
                        <div class="flex flex-col">
                            <label for="">Correo</label>
                            <input wire:model='email' type="email" placeholder="email@dominio.com" class="rounded border-zinc-400">
                        </div>
                        @error('email')
                            <span class="text-red-500">
                                {{$message}}
                            </span>
                        @enderror
        
                        <div class="flex flex-col">
                            <label for="">Contraseña</label>
                            <input wire:model='password' type="password" placeholder="********" class="rounded border-zinc-400">
                        </div>
                        @error('password')
                            <span class="text-red-500">
                                {{$message}}
                            </span>
                        @enderror
                    </fieldset>
        
                    <input type="submit" value="Iniciar Sesión" class="bg-[#003f8c] text-white p-2 mt-6 w-full rounded">
                </form>
            </div>
        </section>
    </div>


    
</main>
