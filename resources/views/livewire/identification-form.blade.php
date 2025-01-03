<?php

use Livewire\Volt\Component;
use App\Models\Patient;
use App\Models\Country;
use App\Models\PostalCode;
use App\Models\State;
use App\Models\IdentificationForm;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public $patient;
    public $countries;
    public $states = [];
    public $settlements = [];
    public $notFoundPC = false;
    public $sectionId;

    public $name;
    public $paternal_surname;
    public $maternal_surname;
    public $gender;
    public $gender_identity;
    public $age;
    public $birthdate;
    public $birthplace;
    public $country;
    public $state;
    public $zip_code;
    public $neighborhood;
    public $street;
    public $number;
    public $religion;
    public $schooling;
    public $occupation;
    public $marital_status;
    public $landline;
    public $cellphone;
    public $email;
    public $parent;
    public $parent_phone;
    public $relationship;
    public $interrogation;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'paternal_surname' => 'required|string|max:255',
            'maternal_surname' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'gender_identity' => 'required',
            'age' => 'required|integer',
            'birthdate' => 'required|date|before:today',
            'birthplace' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|size:5|regex:/^\d{5}$/',
            'neighborhood' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'schooling' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
            'landline' => 'required|string|regex:/^\d{10}$/',
            'cellphone' => 'required|string|regex:/^\d{10}$/',
            'email' => 'required|email|max:255',
            'parent' => 'required|string|max:255',
            'parent_phone' => 'required|string|regex:/^\d{10}$/',
            'relationship' => 'required|string|max:100',
            'interrogation' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'landline.regex' => 'Introduzca su número a 10 dígitos',
            'cellphone.regex' => 'Introduzca su número a 10 dígitos',
            'parent_phone.regex' => 'Introduzca su número a 10 dígitos',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        DB::table('identification_form')->updateOrInsert(
            [
                'email' => $validated['email']
            ],
            [
                'medical_record_sections_id' => 2,
                'gender_identity' => $validated['gender_identity'],
                'age' => $validated['age'],
                'country' => $validated['country'],
                'state' => $validated['state'],
                'zip_code' => $validated['zip_code'],
                'neighborhood' => $validated['neighborhood'],
                'street' => strtoupper($validated['street']),
                'number' => $validated['number'],
                'religion' => $validated['religion'],
                'schooling' => $validated['schooling'],
                'occupation' => $validated['occupation'],
                'marital_status' => $validated['marital_status'],
                'landline' => $validated['landline'],
                'cellphone' => $validated['cellphone'],
                'email' => $validated['email'],
                'parent' => strtoupper($validated['parent']),
                'parent_phone' => $validated['parent_phone'],
                'relationship' => $validated['relationship'],
                'interrogation' => $validated['interrogation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->dispatch('show-notification', message: 'Datos guardados correctamente');
    }

    public function mount()
    {

        $this->sectionId = Patient::find($this->patient['id'])->record->medicalRecordSections->where('name', 'clinic_history')->first()->id;

        $this->name = $this->patient->name;
        $this->paternal_surname = $this->patient->father_last_name;
        $this->maternal_surname = $this->patient->mother_last_name;
        $this->gender = $this->patient->gender;
        $this->birthdate = $this->patient->birthdate;
        $this->birthplace = $this->patient->birthplace;

        $this->countries = Country::get();
        $this->states = collect();
        $this->settlements = collect();

        $identificationForm = Patient::find($this->patient->id)->record->medicalRecordSections->find($this->sectionId)->identificationForm ?? '';
        if($identificationForm) {


            $this->gender_identity = $identificationForm->gender_identity;
            $this->age = $identificationForm->age;
            $this->country = $identificationForm->country;
            $this->states = State::get();
            $this->state = $identificationForm->state;
            $this->zip_code = $identificationForm->zip_code;
            $this->settlements = PostalCode::where('postal_code', $this->zip_code)->first()->settlements;
            $this->neighborhood = $identificationForm->neighborhood;
            $this->street = strtoupper($identificationForm->street);
            $this->number = $identificationForm->number;
            $this->religion = $identificationForm->religion;
            $this->schooling = $identificationForm->schooling;
            $this->occupation = $identificationForm->occupation;
            $this->marital_status = $identificationForm->marital_status;
            $this->landline = $identificationForm->landline;
            $this->cellphone = $identificationForm->cellphone;
            $this->email = $identificationForm->email;
            $this->parent = strtoupper($identificationForm->parent);
            $this->parent_phone = $identificationForm->parent_phone;
            $this->relationship = $identificationForm->relationship;
            $this->interrogation = $identificationForm->interrogation;
        }

        // $this->gender_identity = $identificationForm->gender_identity;
        
        
    }

    public function updatedCountry($value)
    {
        $this->states = Country::where('code', $value)->first()->states;
    }

    public function updatedZipCode($value)
    {
        $this->settlements = PostalCode::where('postal_code', $value)->first()->settlements ?? collect();

        if($this->settlements->isEmpty()) {
            $this->notFoundPC = true;
        } else {
            $this->notFoundPC = false;
        }
        
    }

    public function next()
    {
        $this->save();
        $this->dispatch('next-section');
    }
}; ?>



<form wire:submit='save'>
    <section class="grid grid-cols-5 gap-5">
        <div class="flex flex-col">
            <label for="name" class="uppercase text-xs">Nombre</label>
            <input wire:model='name' type="text" name="name" id="name" autocomplete="name"
                class="rounded text-sm p-1 uppercase">
            @error('name')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="paternal_surname" class="uppercase text-xs">Primer Apellido</label>
            <input wire:model='paternal_surname' type="text" name="paternal_surname" id="paternal_surname"
                class="rounded text-sm p-1 uppercase">
            @error('paternal_surname')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="maternal_surname" class="uppercase text-xs">Segundo Apellido</label>
            <input wire:model='maternal_surname' type="text" name="maternal_surname" id="maternal_surname"
                class="rounded text-sm p-1 uppercase">
            @error('maternal_surname')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="gender" class="uppercase text-xs">Sexo</label>
            <select wire:model='gender' name="gender" id="gender" class="rounded text-sm p-1">
                <option value="">Seleccione una opción</option>
                <option value="male">Masculino</option>
                <option value="female">Femenino</option>
            </select>
            @error('gender')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="gender_identity" class="uppercase text-xs">Identidad de género</label>
            <select wire:model='gender_identity' name="gender_identity" id="gender_identity"
                class="rounded text-sm p-1">
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
            @error('gender_identity')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="age" class="uppercase text-xs">Edad</label>
            <input wire:model='age' type="text" name="age" id="age" class="rounded text-sm p-1">
            @error('age')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="birthdate" class="uppercase text-xs">Fecha de nacimiento</label>
            <input wire:model='birthdate' type="date" name="birthdate" id="birthdate" class="rounded text-sm p-1">
            @error('birthdate')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="birthplace" class="uppercase text-xs">Lugar de nacimiento</label>
            <select wire:model='birthplace' name="birthplace" id="birthplace" class="rounded text-sm p-1">
                <option value="">Seleccione una entidad</option>
                @foreach (State::get() as $state)
                <option value="{{$state->name}}">{{$state->name}}</option>
                @endforeach
            </select>
            @error('birthplace')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </section>

    <section class="mt-10">
        <h3 class="text-2xl text-[#174075]">Domicilio</h2>
            <div class="grid grid-cols-4 gap-5 mt-5">
                <div class="flex flex-col">
                    <label for="country" class="uppercase text-xs">País</label>
                    <select wire:model.live='country'  name="country" id="country" autocomplete="country"
                        class="rounded text-sm p-1">
                        <option value="">Selecciona un país</option>
                        @foreach ($countries as $pais)
                        <option value="{{$pais->code}}">{{$pais->name}}</option>
                        @endforeach
                    </select>
                    @error('country')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="state" class="uppercase text-xs">Estado</label>
                    <select wire:model='state' name="state" id="state" class="rounded text-sm p-1" >
                        <option value="">Selecciona un estado</option>
                        @foreach ($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                    
                    @error('state')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="zip_code" class="uppercase text-xs">Código postal</label>
                    <input wire:model.change='zip_code' type="text" name="zip_code" id="zip_code" class="rounded text-sm p-1"
                        maxlength="5">
                    @error('zip_code')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="neighborhood" class="uppercase text-xs">Colonia</label>
                    <select wire:model='neighborhood' name="neighborhood" id="neighborhood" class="rounded text-sm p-1">
                        <option value="">Selecciona una opción</option>
                        @foreach ($settlements as $settlement)
                            <option value="{{$settlement->name}}">{{$settlement->name}}</option>
                        @endforeach
                    </select>
                    @error('neighborhood')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col col-span-3">
                    <label for="street" class="uppercase text-xs">Calle</label>
                    <input wire:model='street' type="text" name="street" id="street" class="uppercase rounded text-sm p-1">
                    @error('street')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="number" class="uppercase text-xs">Número</label>
                    <input wire:model='number' type="text" name="number" id="number" class="rounded text-sm p-1">
                    @error('number')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
    </section>

    <section class="mt-10">
        <h3 class="text-2xl text-[#174075]">Otros datos</h2>

            <div class="grid grid-cols-4 gap-5 mt-5">
                <div class="flex flex-col">
                    <label for="religion" class="uppercase text-xs">Religión</label>
                    <select wire:model='religion' name="religion" id="religion" class="rounded text-sm p-1">
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
                    @error('religion')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="schooling" class="uppercase text-xs">Escolaridad</label>
                    <select wire:model='schooling' name="schooling" id="schooling" class="rounded text-sm p-1">
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
                    @error('schooling')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="occupation" class="uppercase text-xs">Ocupación</label>
                    <input wire:model='occupation' type="text" name="occupation" id="occupation"
                        class="rounded text-sm p-1">
                    @error('occupation')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="marital_status" class="uppercase text-xs">Estado civil</label>
                    <select wire:model='marital_status' name="marital_status" id="marital_status"
                        class="rounded text-sm p-1">
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
                    @error('marital_status')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="landline" class="uppercase text-xs">Teléfono fijo</label>
                    <input wire:model='landline' type="tel" name="landline" id="landline" class="rounded text-sm p-1"
                        maxlength="10">
                    @error('landline')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="cellphone" class="uppercase text-xs">Teléfono movil</label>
                    <input wire:model='cellphone' type="tel" name="cellphone" id="cellphone" class="rounded text-sm p-1"
                        maxlength="10">
                    @error('cellphone')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col col-span-2">
                    <label for="email" class="uppercase text-xs">Correo Electrónico</label>
                    <input wire:model='email' type="email" name="email" id="email" class="rounded text-sm p-1" autocomplete="email">
                    @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col col-span-2">
                    <label for="parent" class="uppercase text-xs">
                        Responsable legal, padre o tutor
                    </label>
                    <input wire:model='parent' type="text" name="parent" id="parent" class="rounded text-sm p-1">
                    @error('parent')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="parent_phone" class="uppercase text-xs">Teléfono responsable</label>
                    <input wire:model='parent_phone' type="text" name="parent_phone" id="parent_phone"
                        class="rounded text-sm p-1" maxlength="10">
                    @error('parent_phone')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="relationship" class="uppercase text-xs">Parentesco</label>
                    <input wire:model='relationship' type="text" name="relationship" id="relationship"
                        class="rounded text-sm p-1">
                    @error('relationship')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="interrogation" class="uppercase text-xs">Interrogatorio</label>
                    <select wire:model='interrogation' name="interrogation" id="interrogation"
                        class="rounded text-sm p-1">
                        <option value="">Selecciona una opción</option>
                        <option value="direct">Directo</option>
                        <option value="indirect">indirecto</option>
                    </select>
                    @error('interrogation')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
    </section>

    <div class="flex items-center justify-end mt-8">
        <div class="flex gap-3">
            <button wire:click.prevent='next'  class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Siguiente
            </button>

            <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Imprimir
            </button>

            <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Guardar
            </button>
        </div>
    </div>


</form>

@script
<script>
    const ageInput = document.getElementById('age');
    const birthdateInput = document.getElementById('birthdate');
    const countryInput = document.getElementById('country');
    const stateInput = document.getElementById('state');
    const spinner = document.getElementById('loading');
    const postalCodeInput = document.getElementById('zip_code');

    ageInput.addEventListener('input', function () {
        ageInput.value = ageInput.value.replace(/\D/g, '');

        if (ageInput.value.length > 3) {
            ageInput.value = ageInput.value.slice(0, 3);
        }
    });

    $wire.on('next-section', () => {
        setTimeout(() => {
            window.location.href = '/dashboard/expedientes/{{$patient['id']}}/medical-record/family-medical-history';
        }, 2000);
    });

    document.addEventListener('livewire:initialized', () => {
        if(birthdateInput.value != '') {
            const birthdate = new Date(birthdateInput.value);
            const today = new Date();
            let age = today.getFullYear() - birthdate.getFullYear();
            ageInput.value = age;
            $wire.age = age;
        }

        countryInput.addEventListener('input', (e) => {

            if (e.target.value == 'MX') {
                spinner.classList.remove('hidden');

                setTimeout(() => {
                    spinner.classList.add('hidden');
                }, 2000);
            } 
        })

        postalCodeInput.addEventListener('change', (e) => {
            spinner.classList.remove('hidden');

            setTimeout(() => {
                spinner.classList.add('hidden');
                if($wire.notFoundPC) {
                    alert('Código postal no encontrado');
                }
            }, 2000);

            
        })
    });
</script>
@endscript