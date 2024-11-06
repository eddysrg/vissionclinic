<?php

use Carbon\Carbon;
use Livewire\Volt\Component;
use App\Models\Patient;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Validation\Rule;


new class extends Component {
    protected $listeners = ['setPatientInfo'];

    public $isEditing = false;
    public $patientId = '';

    public $clinic_id = ''; 
    public $doctor_id = ''; 
    public $name = ''; 
    public $father_last_name = ''; 
    public $mother_last_name = ''; 
    public $gender = ''; 
    public $birthdate = ''; 
    public $phone_number = ''; 
    public $curp = '';

    public function createPatient()
    {
        $validated = $this->validate([
            'clinic_id' => 'required|numeric',
            'doctor_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'father_last_name' => 'required|string|max:255',
            'mother_last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'birthdate' => 'required|date',
            'phone_number' => 'required|digits:10',
            'curp' => ['required', 'min:18', Rule::unique('patients', 'curp')->ignore($this->patientId)],
        ]);

        Patient::updateOrCreate(['curp' => $validated['curp']], $validated);

        $this->dispatch('show-notification', message: $this->isEditing ? 'Paciente actualizado con éxito' : 'Paciente creado con éxito');
        $this->dispatch('close-modal', 'patientModal');
        $this->dispatch('clearSearch');
        $this->clearForm();
    }

    public function messages() {
        return [
            'curp.unique' => 'El CURP introducido ya se encuentra registrado',
            'phone_number.digits' => 'Coloque un número valido a 10 digitos',
        ];
    }

    public function clearForm()
    {
        $this->isEditing = false;
        $this->clinic_id = ''; 
        $this->doctor_id = ''; 
        $this->name = ''; 
        $this->father_last_name = ''; 
        $this->mother_last_name = ''; 
        $this->gender = ''; 
        $this->birthdate = ''; 
        $this->phone_number = ''; 
        $this->curp = '';

        $this->resetErrorBag();
    }

    public function setPatientInfo($id) {

        $this->isEditing = true;

        $patient = Patient::find($id);

        $this->patientId = $id;

        $this->clinic_id = $patient->clinic_id; 
        $this->doctor_id = $patient->doctor_id; 
        $this->name = $patient->name; 
        $this->father_last_name = $patient->father_last_name; 
        $this->mother_last_name = $patient->mother_last_name; 
        $this->gender = $patient->gender; 
        $this->birthdate = $patient->birthdate; 
        $this->phone_number = $patient->phone_number; 
        $this->curp = $patient->curp;
    }

    public function with()
    {
        return [
            'clinic' => User::find(auth()->id())->clinic,
            'doctors' => Doctor::with(['user' => function ($query) {
                $query->select('id', 'name')
                ->where('clinic_id', 1);
            }])->get(),
        ];
    }

    
}; ?>

<div>
    <x-patient-modal name="patientModal" :show="false" maxWidth="lg">
        <h2 class="p-8 text-xl text-[#174075] shadow-sm">{{$isEditing ? 'Editar Paciente' : 'Paciente nuevo'}}</h2>
        <div class="bg-[#d2f4fc] p-8">

            <form wire:submit='createPatient' class="space-y-10">
                <div class="grid grid-cols-3 gap-10">
                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="clinic_id">Clinica/Consultorio</label>
                        <select wire:model='clinic_id' class="rounded" name="clinic_id" id="clinic_id">
                            <option value="">-- Selecciona una clínica --</option>
                            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                            {{-- @foreach ($clinics as $clinic)
                            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                            @endforeach --}}
                        </select>
                        @error('clinic_id')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="doctor_id">Doctor</label>
                        <select wire:model='doctor_id' class="rounded" name="doctor_id" id="doctor_id">
                            <option value="">-- Selecciona un Doctor --</option>
                            @foreach ($doctors as $doctor)
                            @if ($doctor->user !== null)
                            <option value="{{$doctor->user->id}}">{{$doctor->user->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('doctor_id')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="birthdate">Fecha de nacimiento</label>
                        <input wire:model='birthdate' type="date" class="rounded" name="birthdate" id="birthdate"
                            autocomplete="off">
                        @error('birthdate')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="uppercase text-xs" for="name">Nombre(s)</label>
                        <input wire:model='name' class="rounded" type="text" name="name" id="name" autocomplete="off">
                        @error('name')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="uppercase text-xs" for="father_last_name">Apellido Paterno</label>
                        <input wire:model='father_last_name' class="rounded" type="text" name="father_last_name"
                            id="father_last_name" autocomplete="off">
                        @error('father_last_name')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="uppercase text-xs" for="mother_last_name">Apellido Materno</label>
                        <input wire:model='mother_last_name' class="rounded" type="text" name="mother_last_name"
                            id="mother_last_name" autocomplete="off">
                        @error('mother_last_name')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="uppercase text-xs" for="gender">Sexo</label>
                        <select wire:model='gender' class="rounded" name="gender" id="gender">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="male">Masculino</option>
                            <option value="female">Femenino</option>
                        </select>
                        @error('gender')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="uppercase text-xs" for="phone_number">Número de contacto</label>
                        <input wire:model='phone_number' class="rounded" type="tel" maxlength="10" name="phone_number"
                            id="phone_number" autocomplete="off">
                        @error('phone_number')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="uppercase text-xs" for="curp">Curp</label>
                        <input wire:model='curp' class="rounded" type="text" maxlength="18" name="curp" id="curp"
                            autocomplete="off">
                        @error('curp')
                        <span class="text-red-600 mt-2">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-5 justify-end mr-20">
                    <button type="submit" class="bg-[#0E2F5E] px-8 py-1 rounded-full text-white">Guardar</button>
                    <button x-on:click="$dispatch('close-modal', 'patientModal')" wire:click='clearForm'
                        class="bg-red-600 px-8 py-1 rounded-full text-white" type="button">Cancelar</button>
                </div>
            </form>

        </div>
        <div class="w-full h-10 bg-[#41759D]"></div>
    </x-patient-modal>
</div>