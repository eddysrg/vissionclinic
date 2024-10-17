<x-app-layout>
    <div class="bg-slate-300 flex gap-2 py-2 pl-8">
        <div>

            <i class="fa-solid fa-user-group"></i>
        </div>
        <p class="font-semibold uppercase">Expedientes</p>
    </div>

    <livewire:patient />

    <div class="grid grid-cols-[1fr_.4fr]">
        <div class="p-8">
            <livewire:patient-search />
        </div>

        <div class="p-8">
            <h2 class="bg-[#0E2F5E] text-center p-2 text-white uppercase">Acciones Rápidas</h2>

            <div class="bg-[#13C6ED0D] flex flex-col gap-5 p-10 border">
                <button class="text-white bg-[#41759D] p-3 rounded-md">
                    Registro Paciente Nuevo
                    <i class="fa-solid fa-plus ml-2"></i>
                </button>

                <button class="text-white bg-[#41759D] p-3 rounded-md">
                    Agendar cita
                    <i class="fa-solid fa-plus ml-2"></i>
                </button>

                <button class="text-white bg-[#41759D] p-3 rounded-md">
                    Revisar agenda
                    <i class="fa-solid fa-plus ml-2"></i>
                </button>
            </div>
        </div>
    </div>


</x-app-layout>