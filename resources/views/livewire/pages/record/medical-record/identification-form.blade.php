<?php

use App\Models\{Patient, Country, PostalCode, State, IdentificationForm};
use App\Livewire\Forms\IdentificationCardForm;
use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title, On};
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

new
#[Layout('layouts.record')] 
#[Title('Resumen - Vission Clinic ECE')]
class extends Component {

    public $id;
    public $patient;
    public $isDisabled = false;
    public $countries;
    public $states = [];
    public $settlements = [];
    public IdentificationCardForm $form; 

    public function save()
    {
        $this->form->store();
        $this->dispatch('show-notification', message: 'Datos guardados correctamente');
    }

    #[On('setLocalities')]
    public function setLocalities($zipCode)
    {
        $postalCode = PostalCode::with('settlements.state')
        ->where('postal_code', $zipCode)
        ->first(); 

        if(!$postalCode) {
            return;
        }
        
        $this->settlements = $postalCode->settlements;
        $this->form->state = $postalCode->settlements->first()->state->name;
        $this->form->country = 'MX';
        $this->isDisabled = true;
    }

    public function printIdentificationForm()
    {
        $validated = $this->validate();
        $validated['street'] = strtoupper($validated['street']);
        $validated['birthdate'] = Carbon::parse($validated['birthdate'])->translatedFormat('d \\d\\e F \\d\\e Y');
        $validated['gender'] = $validated['gender'] === 'M' ? 'Femenino' : 'Masculino';
        $validated['interrogation'] = $validated['interrogation'] === 'direct' ? 'Directo' : 'Indirecto';
        $validated['country'] = Country::where('code', $validated['country'])->value('name');
        $validated['birthplace'] = State::where('state_code', $validated['birthplace'])->value('name');

        $pdf = Pdf::loadView('pdf.formPrint', $validated);

        return response()->streamDownload(
            fn () => print($pdf->output()), 'ficha-identificacion.pdf'
        );
    }

    public function next()
    {
        $this->validate();

        return redirect()->route('dashboard.expedientes.medical-record.family-medical-history', ['id' => $this->patient->id]);
    }

    public function mount($id)
    {

        $this->patient = Patient::findOrFail($id);

        $this->authorize('viewRecord', $this->patient);
        $this->id = $id;

        // The clinic_history ID
        $this->form->sectionId = Patient::find($this->patient['id'])->record->medicalRecordSections->where('name', 'clinic_history')->first()->id;

        // General data of the Patient model is mounted
        $this->form->name = $this->patient->name;
        $this->form->paternal_surname = $this->patient->father_last_name;
        $this->form->maternal_surname = $this->patient->mother_last_name;
        $this->form->gender = $this->patient->gender;
        $this->form->birthdate = $this->patient->birthdate;
        $this->form->birthplace = $this->patient->birthplace;

        // The list of countries is placed
        $this->countries = Country::get();

        // The database is searched to see if this form already has a record. If it does, the current data is uploaded.
        $identificationForm = $this->patient->record->medicalRecordSections->firstWhere('id', $this->form->sectionId)?->identificationForm;

        if($identificationForm)
        {
            $this->form->gender_identity = $identificationForm->gender_identity;
            $this->form->age = $identificationForm->age;
            $this->form->country = $identificationForm->country;
            $this->form->state = $identificationForm->state;
            $this->form->zip_code = $identificationForm->zip_code;
            $this->form->neighborhood = $identificationForm->neighborhood;
            $this->form->street = strtoupper($identificationForm->street);
            $this->form->number = $identificationForm->number;
            $this->form->religion = $identificationForm->religion;
            $this->form->schooling = $identificationForm->schooling;
            $this->form->occupation = $identificationForm->occupation;
            $this->form->marital_status = $identificationForm->marital_status;
            $this->form->landline = $identificationForm->landline;
            $this->form->cellphone = $identificationForm->cellphone;
            $this->form->email = $identificationForm->email;
            $this->form->parent = strtoupper($identificationForm->parent);
            $this->form->parent_phone = $identificationForm->parent_phone;
            $this->form->relationship = $identificationForm->relationship;
            $this->form->interrogation = $identificationForm->interrogation;
        }
    }
}; ?>

<div>
    <x-slot:id>
        {{$id}}
    </x-slot>

    <x-notification />

    <h2 class="text-3xl text-[#174075]">Ficha de identificación</h2>

    <form wire:submit='save'>
        <fieldset class="grid grid-cols-4 2xl:grid-cols-5 gap-5">
            <div class="flex flex-col">
                <label for="name" class="text-xs">Nombre</label>
                <input wire:model='form.name' type="text" name="name" id="name" autocomplete="name"
                    class="rounded text-sm p-1 uppercase border-zinc-400">
                @error('form.name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex flex-col">
                <label for="paternal_surname" class="text-xs">Primer Apellido</label>
                <input wire:model='form.paternal_surname' type="text" name="paternal_surname" id="paternal_surname"
                    class="rounded text-sm p-1 uppercase border-zinc-400">
                @error('form.paternal_surname')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex flex-col">
                <label for="maternal_surname" class="text-xs">Segundo Apellido</label>
                <input wire:model='form.maternal_surname' type="text" name="maternal_surname" id="maternal_surname"
                    class="rounded text-sm p-1 uppercase border-zinc-400">
                @error('form.maternal_surname')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex flex-col">
                <label for="gender" class="text-xs">Sexo</label>
                <select wire:model='form.gender' name="gender" id="gender" class="rounded text-sm p-1 border-zinc-400">
                    <option value="">Seleccione una opción</option>
                    <option value="H">Masculino</option>
                    <option value="M">Femenino</option>
                </select>
                @error('form.gender')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex flex-col">
                <label for="gender_identity" class="text-xs">Identidad de género</label>
                <select wire:model='form.gender_identity' name="gender_identity" id="gender_identity"
                    class="rounded text-sm p-1 border-zinc-400">
                    <option value="">Seleccione una opción</option>
                    <option value="not-specified">No especificado</option>
                    <option value="male">Masculino</option>
                    <option value="female">Femenino</option>
                    <option value="transgender">Transgénero</option>
                    <option value="transsexual">Transexual</option>
                    <option value="transvestite">Travesti</option>
                    <option value="intersex">Intersexual</option>
                    <option value="other">Otro</option>
                </select>
                @error('form.gender_identity')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex flex-col">
                <label for="birthdate" class="text-xs">Fecha de nacimiento</label>
                <input wire:model='form.birthdate' type="date" name="birthdate" id="birthdate" class="rounded text-sm p-1 border-zinc-400">
                @error('form.birthdate')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex flex-col">
                <label for="age" class="text-xs">Edad</label>
                <input wire:model='form.age' type="text" disabled name="age" id="age" class="rounded text-sm p-1 border-zinc-400 bg-zinc-100">
                @error('form.age')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex flex-col">
                <label for="birthplace" class="text-xs">Lugar de nacimiento</label>
                <select wire:model='form.birthplace' name="birthplace" id="birthplace" class="rounded text-sm p-1 border-zinc-400">
                    <option value="">Seleccione una entidad</option>
                    @foreach (State::pluck('state_code', 'name') as $name => $state_code)
                    <option value="{{$state_code}}">{{$name}}</option>
                    @endforeach
                    <option value="EX">Nacido en el extranjero</option>
                </select>
                @error('form.birthplace')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>
    
        <fieldset class="mt-10">
            <legend class="text-2xl text-[#174075]">Domicilio</legend>
    
            <div class="grid grid-cols-4 gap-5 mt-5">
    
                <div class="flex flex-col col-span-3">
                    <label for="street" class="text-xs">Calle</label>
                    <input wire:model='form.street' type="text" name="street" id="street" class="uppercase rounded text-sm p-1 border-zinc-400">
                    @error('form.street')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="number" class="text-xs">Número</label>
                    <input wire:model='form.number' type="text" name="number" id="number" class="rounded text-sm p-1 border-zinc-400">
                    @error('form.number')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="zip_code" class="text-xs">Código postal</label>
                    <input wire:model='form.zip_code' type="text" name="zip_code" id="zip_code" class="rounded text-sm p-1 border-zinc-400"
                        maxlength="5">
                    @error('form.zip_code')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="neighborhood" class="text-xs">Colonia</label>
                    <select wire:model='form.neighborhood' name="neighborhood" id="neighborhood" class="rounded text-sm p-1 border-zinc-400">
                        <option value="">Selecciona una opción</option>
                        {{-- <option value="NE">Colonia extranjera</option> --}}
                        @foreach ($settlements as $settlement)
                            <option value="{{$settlement->name}}">{{$settlement->name}}</option>
                        @endforeach
                    </select>
                    @error('form.neighborhood')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="state" class="text-xs">Estado</label>
                    <input type="text" wire:model='form.state' name="state" id="state" class="rounded text-sm p-1 border-zinc-400 disabled:bg-zinc-100" {{ $isDisabled ? 'disabled' : '' }}>
                    @error('form.state')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="country" class="text-xs">País</label>
                    <select wire:model='form.country' name="country" id="country" autocomplete="country"
                        class="rounded text-sm p-1 border-zinc-400 disabled:bg-zinc-100" {{ $isDisabled ? 'disabled' : '' }}>
                        <option value="">Selecciona un país</option>
                        @foreach ($countries as $pais)
                        <option value="{{$pais->code}}">{{$pais->name}}</option>
                        @endforeach
                    </select>
                    @error('form.country')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>
    
        <fieldset class="mt-10">
            <legend class="text-2xl text-[#174075]">Otros datos</legend>
    
            <div class="grid grid-cols-4 gap-5 mt-5">
                <div class="flex flex-col">
                    <label for="religion" class="text-xs">Religión</label>
                    <select wire:model='form.religion' name="religion" id="religion" class="rounded text-sm p-1 border-zinc-400">
                        <option value="">Seleccione una religión</option>
                        <option value="buddhist">Budista</option>
                        <option value="catholic">Católica</option>
                        <option value="christian">Cristiana</option>
                        <option value="jew">Judia</option>
                        <option value="muslim">Musulmán</option>
                        <option value="islamic">Islamica</option>
                        <option value="orthodox">Ortodoxa</option>
                        <option value="jehovahs_witness">Testigos de Jehová</option>
                        <option value="protestant">Protestante</option>
                        <option value="other">Otra religión</option>
                        <option value="adventist">Adventista</option>
                        <option value="mormon">Mormón</option>
                        <option value="without_religion">Sin religión</option>
                    </select>
                    @error('form.religion')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="schooling" class="text-xs">Escolaridad</label>
                    <select wire:model='form.schooling' name="schooling" id="schooling" class="rounded text-sm p-1 border-zinc-400">
                        <option value="">Seleccione una opción</option>
                        <option value="preschool">Preescolar</option>
                        <option value="complete_elementary">Primaria completa</option>
                        <option value="incomplete_elementary">Primaria incompleta</option>
                        <option value="complete_secondary">Secundaria completa</option>
                        <option value="incomplete_secondary">Secundaria incompleta</option>
                        <option value="complete_high_school">Preparatoria completa</option>
                        <option value="incomplete_high_school">Preparatoria incompleta</option>
                        <option value="technical">Técnica</option>
                        <option value="bachelor">Licenciatura</option>
                        <option value="master">Maestría</option>
                        <option value="doctorate">Doctorado</option>
                        <option value="other">Otro</option>
                    </select>
                    @error('form.schooling')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="occupation" class="text-xs">Ocupación</label>
                    <input wire:model='form.occupation' type="text" name="occupation" id="occupation"
                        class="rounded text-sm p-1 border-zinc-400">
                    @error('form.occupation')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="marital_status" class="text-xs">Estado civil</label>
                    <select wire:model='form.marital_status' name="marital_status" id="marital_status"
                        class="rounded text-sm p-1 border-zinc-400">
                        <option value="">Seleccione una opción</option>
                        <option value="married">Casado(a)</option>
                        <option value="divorced">Divorciado(a)</option>
                        <option value="single">Soltero(a)</option>
                        <option value="widower">Viudo(a)</option>
                        <option value="concubinage">Concubinato</option>
                        <option value="separated">Separado(a) (En proceso judicial)</option>
                        <option value="other">Otro</option>
                        <option value="ignored">Se ignora</option>
                    </select>
                    @error('form.marital_status')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="landline" class="text-xs">Teléfono fijo</label>
                    <input wire:model='form.landline' type="text" name="landline" id="landline" class="rounded text-sm p-1 border-zinc-400">
                    @error('form.landline')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="cellphone" class="text-xs">Teléfono movil</label>
                    <input wire:model='form.cellphone' type="tel" name="cellphone" id="cellphone" class="rounded text-sm p-1 border-zinc-400">
                    @error('form.cellphone')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col col-span-2">
                    <label for="email" class="text-xs">Correo Electrónico</label>
                    <input wire:model='form.email' type="email" name="email" id="email" class="rounded text-sm p-1 border-zinc-400" autocomplete="email">
                    @error('form.email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col col-span-2">
                    <label for="parent" class="text-xs">
                        Responsable legal, padre o tutor
                    </label>
                    <input wire:model='form.parent' type="text" name="parent" id="parent" class="rounded text-sm p-1 border-zinc-400">
                    @error('form.parent')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="parent_phone" class="text-xs">Teléfono responsable</label>
                    <input wire:model='form.parent_phone' type="text" name="parent_phone" id="parent_phone"
                    class="rounded text-sm p-1 border-zinc-400">
                    @error('form.parent_phone')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="relationship" class="text-xs">Parentesco</label>
                    <input wire:model='form.relationship' type="text" name="relationship" id="relationship"
                        class="rounded text-sm p-1 border-zinc-400">
                    @error('form.relationship')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="flex flex-col">
                    <label for="interrogation" class="text-xs">Interrogatorio</label>
                    <select wire:model='form.interrogation' name="interrogation" id="interrogation"
                        class="rounded text-sm p-1 border-zinc-400">
                        <option value="">Selecciona una opción</option>
                        <option value="direct">Directo</option>
                        <option value="indirect">indirecto</option>
                    </select>
                    @error('form.interrogation')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>
    
        <div class="flex items-center justify-end mt-8">
            <div class="flex gap-3">
                <button wire:click.prevent='next'  class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Siguiente
                </button>
    
                <button type="button" wire:click.prevent='printIdentificationForm' class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Imprimir
                </button>
    
                <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Guardar
                </button>
            </div>
        </div>
    </form>

</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        let birthdateInput = document.getElementById('birthdate');
        let ageInput = document.getElementById('age');
        let countryInput = document.getElementById('country');
        let stateInput = document.getElementById('state');
        let zipCodeInput = document.getElementById('zip_code');
        let landlineInput = document.getElementById('landline');

        birthdateInput.addEventListener('input', calculateAge);

        zipCodeInput.addEventListener('blur', setLocalities);

        if(birthdateInput.value != '') {
            calculateAge();
        }

        if(zipCodeInput.value != '') {
            setLocalities();
        }

        function calculateAge() {
            const birthdate = new Date(birthdateInput.value);
            const today = new Date();
            let age = today.getFullYear() - birthdate.getFullYear();
            ageInput.value = age;
            $wire.form.age = age;
        }

        function setLocalities() {
            let value = zipCodeInput.value;
            $wire.dispatch('setLocalities', {zipCode: value});
        }
    });
</script>
@endscript