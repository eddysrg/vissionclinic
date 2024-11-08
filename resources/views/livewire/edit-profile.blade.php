<?php
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

new class extends Component {

    use WithFileUploads;


    public $profile_photo;

    public function updatePhoto()
    {
        $validated = $this->validate([
            'profile_photo' => 'required|image|mimes:png,jpg|max:2048'
        ]);

        $user = auth()->user();

        if($user->profile_photo) {
            Storage::delete($user->profile_photo);
        }

        $path = $this->profile_photo->store('profile_photos', 'public');

        $user->profile_photo = $path;

        $user->save();

        // $this->dispatch('show-notification', message: 'Foto de perfil actualizada');
        $this->redirectRoute('profile');
    }


}; ?>

<div class="p-8">
    <h2 class="text-xl uppercase text-[#174075]">Foto de perfil</h2>
    <div class="mt-10">

        <div class="w-36 h-36 bg-[#174075] aspect-square mb-5">
            @if (auth()->user()->profile_photo)
            <img class="w-full h-full object-cover" src="{{asset('storage/' . auth()->user()->profile_photo)}}"
                alt="profile photo">

            @else
            <img class="w-full h-full p-5" src="{{asset('images/profile_photo_icon.png')}}" alt="profile photo">
            @endif
        </div>

        <form wire:submit='updatePhoto'>
            <div class="flex flex-col gap-2">
                <label class="text-[#174075]" for="profile_photo">+ Subir foto de perfil</label>
                <input wire:model='profile_photo' class="w-fit" type="file" name="profile_photo" id="profile_photo"
                    accept="image/png, image/jpeg">

                @error('profile_photo')
                <span class="text-red-600 mt-2">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button class="px-5 py-3 bg-[#174075] rounded text-white mt-5" type="submit">Guardar</button>
        </form>
    </div>

    <h2 class="text-xl uppercase text-[#174075] mt-10">Editar información</h2>
    <p class="mt-3">Edite su información en <a class="text-[#03BCF6]" href="{{route('manageUsers')}}">"Administrar
            Usuarios"</a></p>

</div>