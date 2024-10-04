<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On; 


new class extends Component {
    public $appointmentStatus = null;

    protected $listeners = ['patientId'];

    public function patientId($id) {
        dd("Hola bandera mi id es: " . $id);
    }
}; ?>

<div>
    <form wire:submit='createPatient' class="space-y-10">

        <div class="grid grid-cols-4 gap-10">
            <div class="flex flex-col gap-2">
                <label class="text-xs text-[#41759D]" for="appointment_date">Fecha:</label>
                <input type="date" class="rounded bg-[#89b4cc] border-none" name="appointment_date"
                    id="appointment_date" autocomplete="off">
                @error('')
                <span class="text-red-600 mt-2">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xs text-[#41759D]" for="appointment_time">Hora:</label>
                <input type="time" class="rounded bg-[#89b4cc] border-none" name="appointment_time"
                    id="appointment_time" autocomplete="off">
                @error('')
                <span class="text-red-600 mt-2">
                    {{ $message }}
                </span>
                @enderror

            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xs text-[#41759D]" for="appointment_type">Tipo de consulta:</label>
                <select class="rounded bg-[#89b4cc] border-none" name="appointment_type" id="appointment_type">
                    <option value="">-- Selecciona una opción --</option>
                    <option value="1">Crónicos</option>
                    <option value="2">Sanos</option>
                    <option value="3">Laboratorio</option>
                    <option value="4">Odontología</option>
                </select>
                @error('')
                <span class="text-red-600 mt-2">
                    {{ $message }}
                </span>
                @enderror

            </div>
        </div>

        <div class="grid grid-cols-4 gap-10">
            <div class="col-span-3 flex flex-col gap-2">
                <label class="uppercase text-xs" for="appointment_comments">Observaciones</label>
                <textarea id="appointment_comments" class="h-32"></textarea>
            </div>

            <button wire:click='prueba'
                class="{{is_null($appointmentStatus) ? 'bg-amber-500' : ($appointmentStatus ? 'bg-green-500' : 'bg-red-500')}} place-self-center px-8 py-3 rounded-lg text-white">Confirmar
                Cita</button>
        </div>
    </form>
</div>