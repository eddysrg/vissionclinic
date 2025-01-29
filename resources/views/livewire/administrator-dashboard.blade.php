<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;


new 
#[Layout('layouts.administrator_dashboard')]
class extends Component {
    //
}; ?>

<main class="flex-1 p-8">
    <h1 class="text-2xl text-[#174075] mb-5">
        Administrador de usuarios
    </h1>

    <p class="text-gray-700">Recuerde dar de alta la clinica o consultorio a la que asignara los usuarios correspondientes.</p>

    <div class="mt-10">
        <table class="w-full table-fixed border-collapse">
            <thead class="bg-[#174075] text-white">
                <tr>
                    <th class="rounded-tl rounded-bl p-3 font-normal">Nombre completo</th>
                    <th class="p-3 font-normal">Usuario</th>
                    <th class="p-3 font-normal">Rol</th>
                    <th class="p-3 font-normal">Correo</th>
                    <th class="p-3 font-normal">Fecha de creación</th>
                    <th class="p-3 rounded-tr rounded-br font-normal">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</main>
