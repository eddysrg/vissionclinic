<?php

use Livewire\Volt\Component;
use App\Models\Patient;

new class extends Component {
    //

    public $appointmentStatus = null;

    public $patientData = [
        'date' => '',
        'time' => '',
        'doctor' => '',
        'patient_name' => '',
        'fathers_last_name' => '',
        'mothers_last_name' => '',
        'gender' => '',
        'age' => '',
        'phone_number' => '',
        'curp' => '',
    ];  

    protected function rules()
    {
        return [
            'patientData.date' => 'required|date', 
            'patientData.time' => 'required|date_format:H:i',
            'patientData.doctor' => 'required|string|max:255',
            'patientData.patient_name' => 'required|string|max:255',
            'patientData.fathers_last_name' => 'required|string|max:255',
            'patientData.mothers_last_name' => 'required|string|max:255',
            'patientData.gender' => 'required|in:M,F',
            'patientData.age' => 'required|integer|min:0|max:150',
            'patientData.phone_number' => 'required|digits:10',
            'patientData.curp' => 'required|min:18|unique:App\Models\Patient,curp',
        ];
    }

    public function messages() {
        return [
            'patientData.curp.unique' => 'El CURP introducido ya se encuentra registrado'
        ];
    }

    public function clearForm()
    {
        $this->patientData = [
            'date' => '',
            'time' => '',
            'doctor' => '',
            'patient_name' => '',
            'fathers_last_name' => '',
            'mothers_last_name' => '',
            'gender' => '',
            'age' => '',
            'phone_number' => '',
            'curp' => ''
        ]; 

        $this->resetErrorBag();
    }

    public function createPatient()
    {
        $this->validate();

        Patient::create([
            'date' => $this->patientData['date'],
            'time' => $this->patientData['time'],
            'doctor' => $this->patientData['doctor'],
            'patient_name' => $this->patientData['patient_name'],
            'fathers_last_name' => $this->patientData['fathers_last_name'],
            'mothers_last_name' => $this->patientData['mothers_last_name'],
            'gender' => $this->patientData['gender'],
            'age' => $this->patientData['age'],
            'phone_number' => $this->patientData['phone_number'],
            'curp' => $this->patientData['curp'],
        ]);

        $this->dispatch('show-success');
        $this->dispatch('close-modal');
        $this->clearForm();
    }
}; ?>

<div>
    <div x-data="{ showSuccessMessage: false}"
        x-on:show-success.window="showSuccessMessage = true; setTimeout(() => showSuccessMessage = false, 3000)">

        <button x-data x-on:click="$dispatch('open-modal')" class="text-xs text-white bg-[#41759D] p-3 rounded-md">
            Registro Paciente Nuevo
            <i class="fa-solid fa-plus ml-2"></i>
        </button>

        <div x-show="showSuccessMessage" x-transition:enter="transition ease-out duration-300"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-600 bg-opacity-60" style="display: none">
            <div
                class="bg-gradient-to-b from-[#41759D] to-[#0E2F5E] text-white px-8 py-4 rounded-lg flex justify-center items-center w-1/3 h-1/3">
                <p class="text-3xl flex items-center gap-3">
                    Registro Exitoso
                    <i class="fa-solid fa-circle-check"></i>
                </p>
            </div>
        </div>

        <div x-data="{show: false}" x-show="show" x-on:open-modal.window="show = true"
            x-on:close-modal.window="show = false" x-on:keydown.escape.window="show = false"
            class="fixed z-50 inset-0 overflow-y-hidden" style="display: none">

            <div x-on:click="show = false" wire:click='clearForm()' class="fixed inset-0 bg-gray-600 opacity-40"></div>

            <div class="flex justify-center items-center min-h-screen">
                <div class="w-4/5 bg-white shadow-lg rounded z-10 overflow-hidden">

                    <h2 class="p-6 text-xl text-[#174075] shadow-sm">Paciente Nuevo</h2>

                    <div class="bg-[#d2f4fc] p-6">

                        <form wire:submit='createPatient' class="space-y-10">

                            <div class="grid grid-cols-4 gap-10">
                                <div class="flex flex-col gap-2">
                                    <label class="text-xs text-[#41759D]" for="date">Fecha:</label>
                                    <input wire:model='patientData.date' type="date"
                                        class="rounded bg-[#89b4cc] border-none" name="date" id="date"
                                        autocomplete="off">
                                    @error('patientData.date')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs text-[#41759D]" for="time">Hora:</label>
                                    <input wire:model='patientData.time' type="time"
                                        class="rounded bg-[#89b4cc] border-none" name="time" id="time"
                                        autocomplete="off">
                                    @error('patientData.time')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs text-[#41759D]" for="doctor">Medico:</label>
                                    <select wire:model='patientData.doctor' class="rounded bg-[#89b4cc] border-none"
                                        name="doctor" id="doctor">
                                        <option value="">-- Selecciona un doctor --</option>
                                        <option value="inventado">Dr Inventado</option>
                                    </select>
                                    @error('patientData.doctor')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="grid grid-cols-4 gap-10">
                                <div class="flex flex-col gap-2">
                                    <label class="uppercase text-xs" for="patient_name">Nombre</label>
                                    <input wire:model='patientData.patient_name' class="rounded" type="text"
                                        name="patient_name" id="patient_name" autocomplete="off">
                                    @error('patientData.patient_name')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="uppercase text-xs" for="fathers_last_name">Primer Apellido</label>
                                    <input wire:model='patientData.fathers_last_name' class="rounded" type="text"
                                        name="fathers_last_name" id="fathers_last_name" autocomplete="off">
                                    @error('patientData.fathers_last_name')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="uppercase text-xs" for="mothers_last_name">Segundo Apellido</label>
                                    <input wire:model='patientData.mothers_last_name' class="rounded" type="text"
                                        name="mothers_last_name" id="mothers_last_name" autocomplete="off">
                                    @error('patientData.mothers_last_name')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="uppercase text-xs" for="gender">Sexo</label>
                                    <select wire:model='patientData.gender' class="rounded" name="gender" id="gender">
                                        <option value="">-- Selecciona una opción --
                                        </option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                    @error('patientData.gender')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="uppercase text-xs" for="age">Edad</label>
                                    <input wire:model='patientData.age' class="rounded" type="number" maxlength="3"
                                        name="age" id="age" autocomplete="off">
                                    @error('patientData.age')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="uppercase text-xs" for="phone_number">Número de contacto</label>
                                    <input wire:model='patientData.phone_number' class="rounded" type="tel"
                                        maxlength="10" name="phone_number" id="phone_number" autocomplete="off">
                                    @error('patientData.phone_number')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="uppercase text-xs" for="curp">Curp</label>
                                    <input wire:model='patientData.curp' class="rounded" type="text" maxlength="18"
                                        name="curp" id="curp" autocomplete="off">
                                    @error('patientData.curp')
                                    <span class="text-red-600 mt-2">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex gap-5 justify-end mr-20">
                                <button type="submit"
                                    class="bg-[#0E2F5E] px-8 py-1 rounded-full text-white">Guardar</button>
                                <button x-on:click="$dispatch('close-modal')" wire:click='clearForm()'
                                    class="bg-red-600 px-8 py-1 rounded-full text-white" type="button">Cancelar</button>
                            </div>
                        </form>
                    </div>

                    <div class="w-full h-10 bg-[#41759D]"></div>
                </div>
            </div>
        </div>
    </div>
</div>