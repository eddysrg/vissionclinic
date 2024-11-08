<x-app-layout>
    <x-slot name="meta">
        <title>Vission Clinic ECE Agenda</title>
        <meta name="description" content="">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="robots" content="index,follow">
    </x-slot>

    <x-slot name="fullCalendarJs">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    </x-slot>

    <div class="p-6">
        <h1 class="bg-white text-xl text-[#174075]">Agenda médica</h1>

        <livewire:calendar />
    </div>
</x-app-layout>