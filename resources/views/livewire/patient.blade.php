<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On; 
use Livewire\Volt\Component;
use App\Models\Patient;
use App\Models\Record;
use App\Models\MedicalRecordSection;
use App\Models\User;
use App\Models\Doctor;
use App\Models\State;
use App\Notifications\DashboardNotification;
use App\Services\CurpGenerator;


new class extends Component {

    protected $listeners = ['setPatientInfo'];

    public $doctors = [];

    public $clinic;

    public $curpSuggestion;

    public $isEditing = false;

    public $patientId;

    public $clinic_id; 

    public $doctor_id; 

    public $name;

    public $father_last_name; 

    public $mother_last_name; 

    public $gender;

    public $birthdate; 

    public $birthplace;

    public $phone_number;

    public $curp;

    public $states;

    protected function rules()
    {
        return [
            'clinic_id' => 'required|numeric',
            'doctor_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'father_last_name' => 'required|string|max:255',
            'mother_last_name' => 'required|string|max:255',
            'gender' => 'required|in:H,M',
            'birthdate' => 'required|date',
            'birthplace' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'curp' => ['required', 'min:18', Rule::unique('patients', 'curp')->ignore($this->patientId)],
        ];
    }

    protected function messages() {
        return [
            'curp.unique' => 'El CURP introducido ya se encuentra registrado',
        ];
    }

    public function createPatient()
    {
        $validated = $this->validate();

        $this->createRecord($validated);


        $this->dispatch('show-notification', message: $this->isEditing ? 'Paciente actualizado con éxito' : 'Paciente creado con éxito');
        $this->dispatch('close-modal', 'patientModal');
        $this->dispatch('clearSearch');
        auth()->user()->notify(new DashboardNotification());
        $this->clearForm();
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
        $this->birthplace = ''; 
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
        $this->birthplace = $patient->birthplace; 
        $this->phone_number = $patient->phone_number; 
        $this->curp = $patient->curp;
    }

    public function createRecord($validated)
    {
        DB::transaction(function () use ($validated) {
            $patientCreated = Patient::updateOrCreate(['curp' => $validated['curp']], $validated);

            $recordCreated = Record::create([
                'patient_id' => $patientCreated->id,
                'type_record_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $sectionsCreated = DB::table('medical_record_sections')->insert([
                [
                    'record_id' => $recordCreated->id,
                    'name' => 'summary',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'record_id' => $recordCreated->id,
                    'name' => 'clinic_history',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'record_id' => $recordCreated->id,
                    'name' => 'medical_consultation',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'record_id' => $recordCreated->id,
                    'name' => 'laboratory',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'record_id' => $recordCreated->id,
                    'name' => 'reference',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'record_id' => $recordCreated->id,
                    'name' => 'prescriptions',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'record_id' => $recordCreated->id,
                    'name' => 'pediatric_history',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'record_id' => $recordCreated->id,
                    'name' => 'digital_file',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        });

    }
    
    #[On('generateCurp')] 
    public function generateCurp()
    {
        if($this->name && $this->father_last_name && $this->mother_last_name && $this->birthplace && $this->birthdate && $this->gender) {
            $this->curpSuggestion = CurpGenerator::generateCurp($this->name, $this->father_last_name, $this->mother_last_name, $this->gender, $this->birthdate, $this->birthplace);
        }
    }

    public function mount() 
    {
        $this->states = State::get();

        $this->doctors = Doctor::whereHas('user', function($query) {
            $query->where('clinic_id', 1);
        })->with(['user' => function($query){
            $query->select('id', 'degree', 'name', 'father_lastname', 'mother_lastname');
        }])->get();

        $this->clinic = User::find(auth()->id())->clinic;
    }

}; ?>   

<div>
    <x-patient-modal name="patientModal" :show="false" maxWidth="lg">
        <h2 class="px-8 py-5 text-xl text-[#174075] shadow-sm">{{$isEditing ? 'Editar Paciente' : 'Paciente nuevo'}}</h2>
        <div class="bg-[#d2f4fc] p-8">

            <form wire:submit='createPatient' class="space-y-10">
                <fieldset class="grid grid-cols-3 gap-5">
                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="clinic_id">Clinica/Consultorio</label>
                        <select wire:model='clinic_id' class="rounded text-sm" name="clinic_id" id="clinic_id">
                            <option value="">Selecciona una clínica</option>
                            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                        </select>
                        @error('clinic_id')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="doctor_id">Doctor</label>
                        <select wire:model='doctor_id' class="rounded text-sm" name="doctor_id" id="doctor_id">
                            <option value="">Selecciona un Doctor</option>
                            @foreach ($doctors as $doctor)
                            @if ($doctor->user !== null)
                            <option value="{{$doctor->user->id}}">
                                {{$doctor->user->degree . ' ' . $doctor->user->name . ' ' . $doctor->user->father_lastname . ' ' . $doctor->user->mother_lastname}}
                            </option>
                            @endif
                            @endforeach
                        </select>
                        @error('doctor_id')
                        <span class="text-xs text-red-600"> 
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="birthdate">Fecha de nacimiento</label>
                        <input wire:model='birthdate' type="date" x-on:blur="$dispatch('generateCurp')" class="rounded text-sm" name="birthdate" id="birthdate"
                            autocomplete="off">
                        @error('birthdate')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="birthplace">Entidad de nacimiento</label>
                        <select wire:model='birthplace' x-on:blur="$dispatch('generateCurp')" class="rounded text-sm" name="birthplace" id="birthplace"
                            autocomplete="off">
                            <option value="">Selecciona una opción</option>
                            @foreach ($states as $state)
                            <option value="{{$state->state_code}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                        @error('birthplace')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="name">Nombre(s)</label>
                        <input type="text" wire:model='name' x-on:blur="$dispatch('generateCurp')" class="rounded text-sm"  name="name" id="name" autocomplete="off">
                        @error('name')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="father_last_name">Apellido Paterno</label>
                        <input wire:model='father_last_name' x-on:blur="$dispatch('generateCurp')" class="rounded text-sm" type="text" name="father_last_name"
                            id="father_last_name" autocomplete="off">
                        @error('father_last_name')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="mother_last_name">Apellido Materno</label>
                        <input wire:model='mother_last_name' x-on:blur="$dispatch('generateCurp')" class="rounded text-sm" type="text" name="mother_last_name"
                            id="mother_last_name" autocomplete="off">
                        @error('mother_last_name')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="gender">Sexo</label>
                        <select wire:model='gender' x-on:blur="$dispatch('generateCurp')" class="rounded text-sm" name="gender" id="gender">
                            <option value="">Selecciona una opción</option>
                            <option value="H">Masculino</option>
                            <option value="M">Femenino</option>
                        </select>
                        @error('gender')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="phone_number">Número de contacto</label>
                        <input wire:model='phone_number' class="rounded text-sm" type="tel" name="phone_number"
                            id="phone_number" autocomplete="off" placeholder="Solo 10 dígitos" x-mask="99 9999 9999">
                        @error('phone_number')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs text-[#41759D]" for="curp">CURP</label>
                        <input type="text" wire:model='curp' class="rounded text-sm" maxlength="18" name="curp" id="curp"
                            autocomplete="off">

                        @error('curp')
                            <span class="text-xs text-red-600">
                                {{ $message }}
                            </span>
                        @enderror

                        @if($curpSuggestion)
                            <p class="font-semibold italic text-sm">Sugerencia CURP: 
                            <span class="font-normal" x-text="$wire.curpSuggestion"></span>
                            <button type="button" x-on:click="$wire.curp = $wire.curpSuggestion"><i class="fa-solid fa-copy"></i></button>
                            </p>
                        @endif
                    </div>
                </fieldset>

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