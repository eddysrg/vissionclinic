<?php

use Livewire\Volt\Component;

new class extends Component {
    public function onDateClick($date)
    {
        dd($date);
    }
}; ?>

<div>
    <div class="flex mt-10">
        <div class="w-2/3">
            <div id="calendar"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: "prev,next today",
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,dayGridDay'
                },
                dateClick: function(info) {
                    @this.call('onDateClick', info.dateStr);
                }

            });

            calendar.render();
        });
    </script>
</div>