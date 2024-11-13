<div>
    <h2 class="text-xl uppercase text-[#174075] mb-8">Foto de perfil</h2>

    <div class="w-36 h-36 bg-[#174075] aspect-square mb-5">
        @if (auth()->user()->profile_photo)
        <img id="croppedImage" class="w-full h-full object-cover" src="{{asset(auth()->user()->profile_photo)}}"
            alt="profile photo">
        @else
        <img class="w-full h-full p-5" src="{{asset('images/profile_photo_icon.png')}}" alt="No profile photo">
        @endif
    </div>

    <!-- Formulario para cargar imagen -->
    <input class="mb-10" type="file" id="fileInput" accept="image/*" />

    <!-- Contenedor de previsualización para recorte -->
    <div class="image-preview-container max-w-80 mb-3">
        <img class="max-w-full" id="imagePreview" alt="Previsualización de imagen" />
    </div>

    <!-- Botón para guardar -->
    <button class="button py-2 px-4 bg-[#174075] text-white rounded-full" id="saveButton">
        Guardar Imagen
    </button>
</div>