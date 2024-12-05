<?php

use App\Models\User;
use App\Models\Role;
use App\Models\Clinic;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new class extends Component
{
    public $name = '';
    public $father_lastname = '';
    public $mother_lastname = '';
    public $gender = '';
    public $birthdate = '';
    public $phone_number = '';
    public $curp = '';
    public $rfc = '';
    public $degree = '';
    public $username = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $clinic = '';


    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'father_lastname' => ['required', 'string', 'max:255'],
            'mother_lastname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'phone_number' => ['required', 'string', 'min:10', 'max:10'],
            'curp' => ['required', 'string', 'min:18', 'max:18', 'unique:App\Models\User,curp'],
            'rfc' => ['required', 'string', 'min:13', 'max:13', 'unique:App\Models\User,rfc'],
            'degree' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:App\Models\User,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:App\Models\User,email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'clinic' => ['required', 'string', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        DB::transaction(function () use ($validated) {

            $adminRole = Role::find(1);

            $clinic = Clinic::create(['name' => $validated['clinic']]);

            $user = User::create([
                'clinic_id' => $clinic->id,
                'role_id' => $adminRole->id,
                'name' => $validated['name'],
                'father_lastname' => $validated['father_lastname'],
                'mother_lastname' => $validated['mother_lastname'],
                'gender' => $validated['gender'],
                'birthdate' => $validated['birthdate'],
                'phone_number' => $validated['phone_number'],
                'curp' => $validated['curp'],
                'rfc' => $validated['rfc'],
                'degree' => $validated['degree'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);
        });

        $this->dispatch('show-notification', message: 'Registro de clínica creado correctamente');

        // event(new Registered($user = User::create($validated)));

    }
}; ?>

{{-- <div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username"
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div> --}}

<div>
    <form wire:submit='register'>

        <section>
            <h3 class="text-lg uppercase text-[#174075] mb-5">Datos personales del usuario administrador</h3>

            <div class="grid grid-cols-3 gap-5">
                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Nombre(s)</label>
                    <input wire:model='name' class="rounded border-gray-400 text-sm" type="text"
                        placeholder="Nombre completo">
                    @error('name')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Apellido Paterno</label>
                    <input wire:model='father_lastname' class="rounded border-gray-400 text-sm" type="text"
                        placeholder="Primer apellido">
                    @error('father_lastname')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Apellido Materno</label>
                    <input wire:model='mother_lastname' class="rounded border-gray-400 text-sm" type="text"
                        placeholder="Segundo apellido">
                    @error('mother_lastname')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Género</label>
                    <select wire:model='gender' class="rounded border-gray-400 text-sm" name="" id="">
                        <option value="">Selecciona una opción</option>
                        <option value="male">Masculino</option>
                        <option value="female">Femenino</option>
                    </select>
                    @error('gender')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Fecha de nacimiento</label>
                    <input wire:model='birthdate' class="rounded border-gray-400 text-sm" type="date">
                    @error('birthdate')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Número telefónico</label>
                    <input wire:model='phone_number' class="rounded border-gray-400 text-sm" type="text"
                        placeholder="Número a 10 dígitos" maxlength="10">
                    @error('phone_number')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Curp</label>
                    <input wire:model='curp' class="rounded border-gray-400 text-sm" type="text"
                        placeholder="18 caracteres alfanuméricos" maxlength="18">
                    @error('curp')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Rfc</label>
                    <input wire:model='rfc' class="rounded border-gray-400 text-sm" type="text"
                        placeholder="13 caracteres alfanuméricos" maxlength="13">
                    @error('rfc')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Título</label>
                    <select wire:model='degree' class="rounded border-gray-400 text-sm">
                        <option value="">Selecciona una opción</option>
                        <option value="Dr.">Dr.</option>
                        <option value="Dra.">Dra.</option>
                        <option value="Assistant">Asistente</option>
                    </select>
                    @error('degree')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </section>

        <section class="mt-10">
            <h3 class="text-lg uppercase text-[#174075] mb-5">Datos de acceso</h3>

            <div class="grid grid-cols-4 gap-5">
                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Nombre de usuario</label>
                    <input wire:model='username' class="rounded border-gray-400 text-sm" type="text"
                        placeholder="Ej: luis_juarez">
                    @error('username')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Email</label>
                    <input wire:model='email' class="rounded border-gray-400 text-sm" type="email"
                        placeholder="correo@correo.com">
                    @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Contraseña</label>
                    <input wire:model='password' class="rounded border-gray-400 text-sm" type="password"
                        placeholder="Cree su contraseña">
                    @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm uppercase" for="">Confirmar Contraseña</label>
                    <input wire:model='password_confirmation' class="rounded border-gray-400 text-sm" type="password"
                        placeholder="Repita su contraseña ">
                    @error('password_confirmation')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </section>

        <section class="mt-10">
            <h3 class="text-lg uppercase text-[#174075] mb-5">Datos de la clínica</h3>

            <div class="grid grid-cols-4 gap-5">
                <div class="flex flex-col col-span-2">
                    <label class="text-sm uppercase" for="">Nombre de la clínica</label>
                    <input wire:model='clinic' class="rounded border-gray-400 text-sm" type="text"
                        placeholder="Nombre de la clínica, consultorio o nombre del Dr">
                    @error('clinic')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </section>

        <div class="flex justify-end my-10">
            <button class="bg-[#174075] hover:bg-[#3c5b83] transition-all text-white px-8 py-3 rounded">
                Crear nuevo usuario
            </button>
        </div>

    </form>
</div>