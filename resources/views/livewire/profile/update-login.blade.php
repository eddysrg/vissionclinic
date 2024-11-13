<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public $username = ''; 
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';

    public function mount()
    {
        $this->username = auth()->user()->username;
    }

    /**
     * Update the password for the currently authenticated user.
     */
    public function updateLoginInformation(): void
    {
        $user = Auth::user();

        try {
            $validated = $this->validate([
                'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($user->id)],
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('show-notification', message: 'Datos de acceso actualizados correctamente');
    }
}; ?>

<section>
    <div class="mt-10 pb-20">
        <h2 class="text-xl uppercase text-[#174075] mb-8">Datos de acceso</h2>

        <form wire:submit='updateLoginInformation'>
            <div class="grid grid-cols-4 gap-10 items-center">
                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="username">Nombre de usuario</label>
                    <input wire:model='username' id="username" name="username" class="rounded" type="text"
                        autocomplete="username">
                    @error('username')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="current_password">Clave de acceso actual</label>
                    <input wire:model='current_password' id="current_password" name="current_password" class="rounded"
                        type="password" autocomplete="current-password">
                    @error('current_password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="password">Nueva clave de acceso</label>
                    <input wire:model='password' id="password" class="rounded" type="password"
                        autocomplete="new-password">
                    @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-xs" for="password_confirmation">Confirmar clave</label>
                    <input wire:model='password_confirmation' id="password_confirmation" class="rounded" type="password"
                        autocomplete="new-password">
                    @error('password_confirmation')
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