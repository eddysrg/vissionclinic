@php
$appointmentStatus = null;
@endphp

<x-app-layout>
    <h1 class="bg-white p-6 text-xl text-[#174075]">Agendar Cita</h2>

        <div class="p-6">
            <h2>
                Buscar Paciente
            </h2>
        </div>

        <div class="bg-[#d2f4fc] p-6">

            <form wire:submit='createPatient' class="space-y-10">

                <div class="grid grid-cols-4 gap-10">
                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="date">Fecha:</label>
                        <input wire:model='patientData.date' type="date" class="rounded bg-[#89b4cc] border-none"
                            name="date" id="date" autocomplete="off">
                        @error('patientData.date')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="time">Hora:</label>
                        <input wire:model='patientData.time' type="time" class="rounded bg-[#89b4cc] border-none"
                            name="time" id="time" autocomplete="off">
                        @error('patientData.time')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="doctor">Medico:</label>
                        <select wire:model='patientData.doctor' class="rounded bg-[#89b4cc] border-none" name="doctor"
                            id="doctor">
                            <option value="">-- Selecciona un doctor --</option>
                            <option value="inventado">Dr Inventado</option>
                        </select>
                        @error('patientData.doctor')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="doctor">Tipo de consulta:</label>
                        <select wire:model='patientData.doctor' class="rounded bg-[#89b4cc] border-none" name="doctor"
                            id="doctor">
                            <option value="">-- Selecciona un doctor --</option>
                            <option value="1">Crónicos</option>
                            <option value="2">Sanos</option>
                            <option value="3">Laboratorio</option>
                            <option value="4">Odontología</option>
                        </select>
                        @error('patientData.doctor')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>
                </div>

                <div class="grid grid-cols-4 gap-10">
                    <div class="col-span-3 flex flex-col gap-2">
                        <label class="uppercase text-xs" for="patient_name">Observaciones</label>
                        <textarea class="h-32"></textarea>
                    </div>

                    <button type="submit"
                        class="{{is_null($appointmentStatus) ? 'bg-amber-500' : ($appointmentStatus ? 'bg-green-500' : 'bg-red-500')}} place-self-center px-8 py-3 rounded-lg text-white">Confirmar
                        Cita</button>
                </div>
            </form>
        </div>
</x-app-layout>