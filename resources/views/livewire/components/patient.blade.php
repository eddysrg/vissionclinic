<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use App\Models\{Patient, State, MedicalUnit};
use App\Notifications\DashboardNotification;
use App\Services\CurpGeneratorService;
use App\Services\PatientService;
use App\Repositories\PatientRepository;
use App\Livewire\Forms\PatientForm;


new class extends Component {

    public $user;

    public $states = [];

    public $medical_unit;

    public PatientForm $form;

    public $curpSuggestion;

    // ------------------------------------------

    protected $listeners = ['setPatientInfo'];

    public $isEditing = false;

    public function getPatientServiceProperty()
    {
        return app(PatientService::class);
    }


    public function createPatient()
    {
        $validated = $this->form->validate();

        $this->patientService->createFullPatient($validated);

        $this->dispatch('show-notification', message: $this->isEditing ? 'Paciente actualizado con éxito' : 'Paciente creado con éxito');

        $this->dispatch('close-modal', 'patientModal');

        $this->user->notify(new DashboardNotification());

        $this->clearForm();
    }

    public function updatePatient()
    {
        $validated = $this->form->validate();

        $this->patientService->updatePatient($this->form->patientId, $validated);

        $this->dispatch('show-notification', message: $this->isEditing ? 'Paciente actualizado con éxito' : 'Paciente creado con éxito');

        $this->dispatch('close-modal', 'patientModal');

        $this->clearForm();
    }

    public function clearForm()
    {
        $this->isEditing = false;
        $this->curpSuggestion = '';
        $this->form->medical_unit_id = '';
        $this->form->name = '';
        $this->form->last_name = '';
        $this->form->gender = '';
        $this->form->birthdate = '';
        $this->form->birthplace = '';
        $this->form->phone_number = '';
        $this->form->curp = '';

        $this->form->resetErrorBag();
    }

    public function setPatientInfo($id) {

        $this->isEditing = true;

        $patient = Patient::find($id);

        $this->form->patientId = $id;

        $this->form->medical_unit_id = $patient->medical_unit_id;
        $this->form->name = $patient->name;
        $this->form->last_name = $patient->last_name;
        $this->form->gender = $patient->gender;
        $this->form->birthdate = $patient->birthdate;
        $this->form->birthplace = $patient->birthplace;
        $this->form->phone_number = $patient->phone_number;
        $this->form->curp = $patient->curp;
    }

    #[On('generateCurp')]
    public function generateCurp()
    {
        if($this->isInfoComplete()) {
            $this->curpSuggestion = CurpGeneratorService::generateCURP($this->form->name, $this->form->last_name, $this->form->birthdate, $this->form->gender, $this->form->birthplace);

            return;
        }

        $this->curpSuggestion = '';
    }

    public function isInfoComplete()
    {
        return $this->form->name && (count(explode(' ',$this->form->last_name)) >= 2) && $this->form->birthplace && $this->form->birthdate && $this->form->gender;
    }

    public function mount()
    {
        $this->states = State::all();
        $this->user = auth()->user();
        $this->medical_unit = MedicalUnit::find($this->user->medical_unit_id);
    }

}; ?>

<div>
    <x-patient-modal name="patientModal" :show="false" maxWidth="lg">
        <h2 class="px-8 py-5 text-xl text-[#174075] shadow-sm">{{$isEditing ? 'Editar Paciente' : 'Paciente nuevo'}}</h2>
        <div class="bg-[#d2f4fc] p-8">

            <form wire:submit='createPatient' class="space-y-10">
                <fieldset class="grid grid-cols-6 gap-5">
                    <div class="flex flex-col gap-2 col-span-2">
                        <label class="text-xs text-[#41759D]" for="medical_unit_id">Clinica/Consultorio</label>
                        <select wire:model='form.medical_unit_id' class="rounded text-sm" name="medical_unit_id" id="medical_unit_id">
                            <option value="">Selecciona una unidad médica</option>
                            <option value="{{$medical_unit->id}}">{{$medical_unit->name}}</option>
                        </select>
                        @error('form.medical_unit_id')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="flex flex-col gap-2 col-span-2">
                        <label class="text-xs text-[#41759D]" for="birthdate">Fecha de nacimiento</label>
                        <input wire:model='form.birthdate' type="date" x-on:blur="$dispatch('generateCurp')" class="rounded text-sm" name="birthdate" id="birthdate"
                            autocomplete="off">
                        @error('form.birthdate')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <label class="text-xs text-[#41759D]" for="birthplace">Entidad de nacimiento</label>
                        <select wire:model='form.birthplace' x-on:blur="$dispatch('generateCurp')" class="rounded text-sm" name="birthplace" id="birthplace"
                            autocomplete="off">
                            <option value="">Selecciona una opción</option>
                            @foreach ($states as $state)
                            <option value="{{$state->state_code}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                        @error('form.birthplace')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2 col-span-3">
                        <label class="text-xs text-[#41759D]" for="name">Nombre(s)</label>
                        <input type="text" wire:model='form.name' x-on:blur="$dispatch('generateCurp')" class="rounded text-sm"  name="name" id="name" autocomplete="off">
                        @error('form.name')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2 col-span-3">
                        <label class="text-xs text-[#41759D]" for="last_name">Apellidos</label>
                        <input wire:model.blur='form.last_name' x-on:blur="$dispatch('generateCurp')" class="rounded text-sm" type="text" name="last_name"
                            id="last_name" autocomplete="off">
                        @error('form.last_name')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="flex flex-col gap-2 col-span-2">
                        <label class="text-xs text-[#41759D]" for="gender">Sexo</label>
                        <select wire:model='form.gender' x-on:blur="$dispatch('generateCurp')" class="rounded text-sm" name="gender" id="gender">
                            <option value="">Selecciona una opción</option>
                            <option value="Hombre">Masculino</option>
                            <option value="Mujer">Femenino</option>
                        </select>
                        @error('form.gender')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <label class="text-xs text-[#41759D]" for="phone_number">Número de contacto</label>
                        <input wire:model='form.phone_number' class="rounded text-sm" type="tel" name="phone_number"
                            id="phone_number" autocomplete="off" placeholder="Solo 10 dígitos" maxlength="10">
                        @error('form.phone_number')
                        <span class="text-xs text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <label class="text-xs text-[#41759D]" for="curp">CURP</label>
                        <input type="text" wire:model='form.curp' class="rounded text-sm" maxlength="18" name="curp" id="curp"
                            autocomplete="off">

                        @error('form.curp')
                            <span class="text-xs text-red-600">
                                {{ $message }}
                            </span>
                        @enderror

                        @if($curpSuggestion)
                            <div>
                                <div class="flex items-center gap-3">
                                    <p class="font-semibold italic text-sm">Sugerencia CURP: <span class="font-normal" x-text="$wire.curpSuggestion"></span></p>
                                    <button type="button" x-on:click="$wire.form.curp = $wire.curpSuggestion"><i class="fa-solid fa-copy"></i></button>
                                </div>
                                <span class="text-red-500 italic font-semibold">*Favor de validar con paciente el CURP sugerido*</span>
                            </div>
                        @endif
                    </div>
                </fieldset>

                <div class="flex gap-5 justify-end mr-20">

                    @if($isEditing)
                        <button type="button" wire:click='updatePatient' class="bg-[#0E2F5E] px-8 py-1 rounded-full text-white">Actualizar</button>
                    @else
                        <button type="submit" class="bg-[#0E2F5E] px-8 py-1 rounded-full text-white">Guardar</button>
                    @endif

                    <button x-on:click="$dispatch('close-modal', 'patientModal')" wire:click='clearForm'
                        class="bg-red-600 px-8 py-1 rounded-full text-white" type="button">Cancelar</button>
                </div>
            </form>

        </div>
        <div class="w-full h-10 bg-[#41759D]"></div>
    </x-patient-modal>
</div>
