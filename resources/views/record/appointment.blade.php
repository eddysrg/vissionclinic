<x-app-layout>
    <h1 class="bg-white p-6 text-xl text-[#174075]">Agendar Cita</h1>

    <div class="px-6 mb-6">
        <h2 class="text-[#174075] mb-10">
            Buscar Paciente
        </h2>

        <livewire:patient-search />
    </div>

    <div class="bg-[#d2f4fc] m-6 p-6 pb-20 rounded">

        <livewire:schedule-appointment />
    </div>
</x-app-layout>