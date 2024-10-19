<x-app-layout>
    <div class="p-8">
        <h1 class="bg-white text-xl text-[#174075]">Administración de Usuarios</h1>

        <div class="flex mt-5">
            <button class="px-5 py-3 bg-[#174075] text-white rounded flex items-center gap-2 text-sm">
                <i class="fa-solid fa-plus"></i>
                Agregar usuario
            </button>
        </div>

        <div class="mt-5">
            <div class="grid grid-cols-6 justify-items-center py-5 text-sm text-[#174075] uppercase font-semibold">
                <h4>Nombre Completo</h4>
                <h4>Nombre de usuario</h4>
                <h4>Rol</h4>
                <h4>Correo</h4>
                <h4>Creado</h4>
                <h4>Acciones</h4>
            </div>


            <div class="space-y-3">
                <div class="grid grid-cols-6 justify-items-center py-4 items-center bg-cyan-100 rounded text-sm">
                    <p>Eduardo Ramírez Galindo</p>
                    <p>eddysrg</p>
                    <p>Administrador</p>
                    <p>correo@correo.com</p>
                    <p>{{date('Y-m-d H:i:s')}}</p>
                    <div class="flex gap-5">
                        <button>
                            <i class="fa-solid fa-user-doctor"></i>
                        </button>

                        <button>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <button>
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-6 justify-items-center py-4 items-center bg-cyan-100 rounded text-sm">
                    <p>Eduardo Ramírez Galindo</p>
                    <p>eddysrg</p>
                    <p>Administrador</p>
                    <p>correo@correo.com</p>
                    <p>{{date('Y-m-d H:i:s')}}</p>
                    <div class="flex gap-5">
                        <button>
                            <i class="fa-solid fa-user-doctor"></i>
                        </button>

                        <button>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <button>
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>