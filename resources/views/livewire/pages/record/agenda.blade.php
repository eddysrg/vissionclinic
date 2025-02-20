<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};


new 
#[Layout('layouts.app')]
#[Title('Agenda - Vission Clinic ECE')]
class extends Component {
    //
}; ?>

<x-slot:fullCalendarJs>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
</x-slot>

<main>
    <div class="p-6">
        <h1 class="bg-white text-xl text-[#174075]">Agenda médica</h1>
        @livewire('components.calendar')
    </div>
</main>
