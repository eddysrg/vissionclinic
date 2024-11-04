<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Clinic;
use Livewire\Attributes\On;
 
new class extends Component {

    public $clinic_id;
    public $role_id;
    public $name;
    public $username;
    public $email;
    public $password;

    public $userId = '';
    public $userName = '';

    public $isEditing = false;

    public function rules() 
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'password' => $this->isEditing ? ['nullable'] : ['required', 'string', Rules\Password::defaults()],
            'clinic_id' => ['required', 'numeric'],
            'role_id' => ['required', 'numeric'],
        ];
    }

    public function setUserInfo($id)
    {
        $this->dispatch('open-modal', 'userModal');

        $currentUser = User::find($id);

        $this->name = $currentUser->name;
        $this->username = $currentUser->username;
        $this->email = $currentUser->email;
        $this->clinic_id = $currentUser->clinic_id;
        $this->role_id = $currentUser->role_id;
        $this->isEditing = 1;
        $this->userId = $id;
    }
    
    public function createUser()
    {
        $validated = $this->validate();

        $validated['password'] = Hash::make($validated['password']);
        
        User::create($validated);

        $this->dispatch('show-notification', message: 'Usuario creado correctamente');
        $this->dispatch('close-modal', 'userModal');
    }

    public function updateUser() {
        $validated = $this->validate();

        if($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        }

        User::find($this->userId)->update(array_filter($validated));
        $this->dispatch('show-notification', message: 'Usuario Actualizado correctamente');
        $this->dispatch('close-modal', 'userModal');

    }

    public function deleteUser($idUser) {
        User::find($idUser)->delete();
        $this->dispatch('show-notification', message: 'Usuario eliminado correctamente');
    }

    #[On('setDoctor')]
    public function setDoctor($idUser)
    {
        Doctor::create(['user_id' => $idUser]);

        $this->dispatch('show-notification', message: 'Doctor agregado correctamente');
    }

    #[On('eliminateDoctor')]
    public function eliminateDoctor($idUser)
    {
        // Doctor::create(['user_id' => $idUser]);

        Doctor::where('user_id', $idUser)->delete();
        $this->dispatch('show-notification', message: 'Doctor eliminado de la lista correctamente');
    }

    public function clearForm()
    {
        $this->isEditing = false;
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->clinic_id = '';
        $this->role_id = '';
        $this->resetErrorBag();
    }

    public function with()
    {
        // dd(User::find(auth()->user()->id));
        return [
            'clinic' => User::find(auth()->user()->id)->clinic,
            'roles' => DB::table('roles')->get(),
            'users' => Clinic::find(auth()->user()->clinic_id)->users,
            'doctors' => Doctor::all()
        ];
    }

}; ?>

<div>

    <x-notification />

    <div class="flex mt-5">

        <button @click="$dispatch('open-modal', 'userModal')" x-data
            class="px-5 py-3 bg-[#174075] text-white rounded flex items-center gap-2 text-sm">
            <i class="fa-solid fa-plus"></i>
            Agregar usuario
        </button>

        <x-modal name="userModal" clean='clearForm'>
            <h3 class="bg-white text-lg text-[#174075] mb-10">Información del usuario</h3>

            <form wire:submit={{$isEditing ? 'updateUser' : 'createUser' }}>
                <div class="flex flex-col gap-2 mb-8">
                    <label class="text-xs text-[#41759D]" for="name">Nombre Completo</label>
                    <input wire:model='name' class="rounded border border-zinc-300 @error('name') is-invalid @enderror"
                        type="text" name="name" id="name">
                    @error('name')
                    <span class="text-red-600 text-xs mt-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-8">
                    <label class="text-xs text-[#41759D]" for="username">Nombre de usuario</label>
                    <input wire:model='username'
                        class="rounded border border-zinc-300 @error('username') is-invalid @enderror" type="text"
                        name="username" id="username">
                    @error('username')
                    <span class="text-red-600 text-xs mt-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-8">
                    <label class="text-xs text-[#41759D]" for="email">Correo</label>
                    <input wire:model='email'
                        class="rounded border border-zinc-300 @error('email') is-invalid @enderror" type="email"
                        name="email" id="email">
                    @error('email')
                    <span class="text-red-600 text-xs mt-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-8">
                    <label class="text-xs text-[#41759D]" for="password">Contraseña</label>
                    <input wire:model='password'
                        class="rounded border border-zinc-300 @error('password') is-invalid @enderror" type="password"
                        name="password" id="password">
                    @error('password')
                    <span class="text-red-600 text-xs mt-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-5 mb-8">
                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="clinic">Clínica/Consultorio</label>
                        <select wire:model='clinic_id'
                            class="rounded border border-zinc-300 @error('clinic_id') is-invalid @enderror"
                            name="clinic_id" id="clinic">
                            <option value="">-- Selecciona un Doctor --</option>
                            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                        </select>
                        @error('clinic_id')
                        <span class="text-red-600 text-xs mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="role">Rol del usuario</label>
                        <select wire:model='role_id'
                            class="rounded border border-zinc-300 @error('role_id') is-invalid @enderror" name="role_id"
                            id="role">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <span class="text-red-600 text-xs mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-between">
                    <button type="button" wire:click='clearForm' @click="$dispatch('close-modal', 'userModal')" x-data
                        class="px-5 py-3 bg-red-500 text-white rounded flex items-center gap-2 text-sm">
                        Cancelar
                    </button>

                    <button type="submit"
                        class="px-5 py-3 bg-[#174075] text-white rounded flex items-center gap-2 text-sm">
                        {{$isEditing ? 'Actualizar Usuario' : 'Crear Usuario'}}
                    </button>
                </div>
            </form>
        </x-modal>
    </div>



    <div class="mt-5">
        <div
            class="grid grid-cols-6 justify-items-center py-5 text-sm bg-[#174075] text-white rounded uppercase font-semibold">
            <h4>Nombre Completo</h4>
            <h4>Nombre de usuario</h4>
            <h4>Rol</h4>
            <h4>Correo</h4>
            <h4>Creado</h4>
            <h4>Acciones</h4>
        </div>

        <div>
            @forelse ($users as $user)
            <div
                class="grid grid-cols-6 justify-items-center py-4 items-center rounded text-sm border-b border-gray-300">
                <p>{{$user->name}}</p>
                <p>{{$user->username}}</p>
                <p>{{$user->role->name}}</p>
                <p>{{$user->email}}</p>
                <p>{{$user->created_at}}</p>

                <div class="flex gap-5">
                    @if ($user->doctor)
                    <button wire:click='$dispatch("removeDoctor", {user: {{$user}}})' title="Añadir doctor a la lista">
                        <i class="fa-solid fa-user-doctor text-green-500"></i>
                    </button>
                    @else
                    <button wire:click='$dispatch("addDoctor", {user: {{$user}}})' title="Añadir doctor a la lista">
                        <i class="fa-solid fa-user-doctor text-[#174075]"></i>
                    </button>
                    @endif

                    <button wire:click='setUserInfo({{$user->id}})'>
                        <i class="fa-solid fa-pen-to-square text-[#174075]"></i>
                    </button>

                    @if ($users->where('role_id', 1)->count() === 1 && $user->role_id === 1)
                    <button disabled class="cursor-not-allowed">
                        <i class="fa-solid fa-trash text-gray-300"></i>
                    </button>
                    @else
                    <button wire:click='deleteUser({{$user->id}})'
                        wire:confirm='¿Estás seguro de eliminar este usuario?'>
                        <i class="fa-solid fa-trash text-red-500"></i>
                    </button>
                    @endif
                </div>
            </div>
            @empty
            <p class="bg-cyan-100 rounded py-10 text-center">No hay registros</p>
            @endforelse
        </div>

    </div>

</div>

@script
<script>
    $wire.on('addDoctor', (event) => {

        let idUser = event.user.id;

        let respuesta = confirm('¿Deseas agregar a este usuario a la lista de doctores?');

        if(respuesta) {
            $wire.dispatch('setDoctor', {idUser});
        }
    })

    $wire.on('removeDoctor', (event) => {

        let idUser = event.user.id;

        let respuesta = confirm('¿Deseas eliminar a este usuario de la lista de doctores?');

        if(respuesta) {
            $wire.dispatch('eliminateDoctor', {idUser});
        }
    })
</script>
@endscript