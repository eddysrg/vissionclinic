<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public $degree = ''; 
    public $name = ''; 
    public $father_lastname = ''; 
    public $mother_lastname = ''; 
    public $gender = '';
    public $birthdate = '';
    public $phone_number = '';
    public $email = '';
    public $curp = ''; 
    public $rfc = ''; 

    public function mount()
    {
        $this->degree = auth()->user()->degree;
        $this->name = auth()->user()->name;
        $this->father_lastname = auth()->user()->father_lastname;
        $this->mother_lastname = auth()->user()->mother_lastname;
        $this->gender = auth()->user()->gender;
        $this->birthdate = auth()->user()->birthdate;
        $this->phone_number = auth()->user()->phone_number;
        $this->email = auth()->user()->email;
        $this->curp = auth()->user()->curp;
        $this->rfc = auth()->user()->rfc;
        $this->username = auth()->user()->username;
    }

    public function updateProfileInformation()
    {
        $user = Auth::user();

        $validated = $this->validate([
            
            'degree' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'father_lastname' => ['required', 'string', 'max:255'],
            'mother_lastname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'birthdate' => ['required', 'date'],
            'phone_number' => ['required', 'digits:10'],
            'email' => ['required', 'email', Rule::unique(User::class)->ignore($user->id)],
            'rfc' => ['required', 'min:13', Rule::unique(User::class)->ignore($user->id)],
            'curp' => ['required', 'min:18', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();


        $this->dispatch('show-notification', message: 'Perfil actualizado correctamente');
    }
}; ?>

<section>
    <div class="mt-10 pb-10 border-b border-dotted border-black">
        <h2 class="text-xl uppercase text-[#174075] mb-8">Perfil</h2>

        <form wire:submit='updateProfileInformation'>
            <div class="grid grid-cols-5 gap-10">
                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="degree">Grado</label>
                    <select wire:model='degree' name="degree" id="degree">
                        <option value="">--Selecciona una opción--</option>
                        <option value="Dr.">Dr.</option>
                        <option value="Dra.">Dra.</option>
                        <option value="Asistente">Asistente</option>
                    </select>
                    @error('degree')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="name">Nombre</label>
                    <input wire:model='name' id="name" name="name" class=" rounded" type="text" autocomplete="name">
                    @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="father_lastname">Apellido Paterno</label>
                    <input wire:model='father_lastname' id="father_lastname" name="father_lastname" class="rounded"
                        type="text">
                    @error('father_lastname')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="mother_lastname">Apellido Materno</label>
                    <input wire:model='mother_lastname' id="mother_lastname" name="mother_lastname" class="rounded"
                        type="text">
                    @error('mother_lastname')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="gender">Sexo</label>
                    <select wire:model='gender' id="gender" name="gender" class="rounded" name="" id="">
                        <option value="">--Selecciona una opción</option>
                        <option value="male">Masculino</option>
                        <option value="female">Femenino</option>
                    </select>
                    @error('gender')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="birthdate">Fecha Nacimiento</label>
                    <input wire:model='birthdate' id="birthdate" name="birthdate" class="rounded" type="date">
                    @error('birthdate')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="phone_number">Teléfono</label>
                    <input wire:model='phone_number' id="phone_number" name="phone_number" class="rounded" type="text"
                        maxlength="10">
                    @error('phone_number')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="email">Correo electrónico</label>
                    <input wire:model='email' id="email" name="email" class="rounded" type="text" autocomplete="email">
                    @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="rfc">RFC</label>
                    <input wire:model='rfc' id="rfc" name="rfc" class="rounded" type="text">
                    @error('rfc')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="curp">Curp</label>
                    <input wire:model='curp' id="curp" name="curp" class="rounded" type="text">
                    @error('curp')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-5">
                <button class="button py-2 px-10 bg-[#174075] text-white rounded-full mt-5"
                    type="submit">Guardar</button>
            </div>
        </form>
    </div>
</section>