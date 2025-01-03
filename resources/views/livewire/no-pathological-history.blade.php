<?php

use Livewire\Volt\Component;
use App\Models\Patient;
use App\Models\NoPathologicalHistory;

new class extends Component {

    public $patient;
    public $sectionId;


    public $diet;
    public $physicalActivity;
    public $hygiene;
    public $smoke = ['smoke' => ''  ,'isSmoker' => false, 'observations' => ''];
    public $alcohol = ['drink' => ''  ,'isDrinker' => false, 'observations' => ''];
    public $drugs = ['addict' => ''  ,'isDrugAddict' => false, 'observations' => ''];
    public $housingType;
    public $geographicalArea;
    public $socioeconomicLevel;
    public $services = ['light' => false, 'water' => false, 'drainage' => false];
    public $fauna = ['fauna' => '', 'observations' => ''];
    public $promiscuity = ['promiscuity' => '', 'observations' => ''];
    public $overcrowding = ['overcrowding' => '', 'observations' => ''];
    public $immunizations = ['status' => '', 'observations' => ''];

    public $bloodType = [
        'group' => '',
        'type' => '',
        'verified' => ''
    ];

    public function save()
    {
        $validated = $this->validate([
            'bloodType.group' => 'string',
            'bloodType.type' => 'string',
            'bloodType.verified' => 'string',
            'diet' => 'nullable|string|in:Mala,Regular,Buena',
            'physicalActivity' => 'nullable|string|in:Mala,Regular,Buena',
            'hygiene' => 'nullable|string|in:Mala,Regular,Buena',
            'smoke.smoke' => 'nullable|string|in:Si,No',
            'smoke.isSmoker' => 'boolean',
            'smoke.observations' => 'string',
            'alcohol.drink' => 'nullable|string|in:Si,No',
            'alcohol.isDrinker' => 'boolean',
            'alcohol.observations' => 'string',
            'drugs.addict' => 'nullable|string|in:Si,No',
            'drugs.isDrugAddict' => 'boolean',
            'drugs.observations' => 'string',
            'housingType' => 'nullable|string|in:concrete,wood,cardboard',
            'geographicalArea' => 'nullable|string|in:urban,rural',
            'socioeconomicLevel' => 'nullable|string|in:veryLow,low,medium,mediumHigh,hight',
            'services.light' => 'boolean',
            'services.water' => 'boolean',
            'services.drainage' => 'boolean',
            'fauna.fauna' => 'nullable|string|in:Si,No',
            'fauna.observations' => 'string',
            'promiscuity.promiscuity' => 'nullable|string|in:Si,No',
            'promiscuity.observations' => 'string',
            'overcrowding.overcrowding' => 'nullable|string|in:Si,No',
            'overcrowding.observations' => 'string',
            'immunizations.status' => 'nullable|string|in:complete,incomplete',
            'immunizations.observations' => 'string',
        ]);

        $noPathologicalHistory = NoPathologicalHistory::updateOrCreate(
            ['medical_record_sections_id' => $this->sectionId],
            [
                'medical_record_sections_id' => $this->sectionId,
                'blood_type' =>json_encode($this->bloodType),
                'diet' => $this->diet,
                'physical_activity' => $this->physicalActivity,
                'hygiene' => $this->hygiene,
                'smoke' => json_encode($this->smoke),
                'alcohol' => json_encode($this->alcohol),
                'drugs' => json_encode($this->drugs),
                'housing_type' => $this->housingType,
                'geographical_area' => $this->geographicalArea,
                'socioeconomic_level' => $this->socioeconomicLevel,
                'services' => json_encode($this->services),
                'fauna' => json_encode($this->fauna),
                'promiscuity' => json_encode($this->promiscuity),
                'overcrowding' => json_encode($this->overcrowding),
                'immunizations' => json_encode($this->immunizations)
            ]
        );

        $this->dispatch('show-notification', message: 'Datos guardados correctamente');
    }

    public function next()
    {
        $this->save();
        $this->dispatch('next-section');

    }

    public function previous()
    {
        $this->save();
        $this->dispatch('previous-section');
    }

    public function mount()
    {
        $this->sectionId = Patient::find($this->patient['id'])->record->medicalRecordSections->where('name', 'clinic_history')->first()->id;
    }

}; ?>
<div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit='save'>
        <article class="grid gap-5 mt-10">
            <section>
                <div class="flex items-center gap-3">
                    <div>
                        <label for="bloodType">Tipo de sangre</label>
                        <select wire:model='bloodType.group' id="bloodType" class="py-1 rounded border-zinc-300">
                            <option value="">Selecciona grupo</option>
                            <option value="o">O</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="ab">AB</option>
                        </select>
                    </div>
    
                    <div>
                        <select wire:model='bloodType.type' class="py-1 rounded border-zinc-300" name="" id="">
                            <option value="">Selecciona tipo de sangre</option>
                            <option value="positive">Positivo</option>
                            <option value="negative">Negativo</option>
                        </select>
                    </div>
    
                    <div>
                        <select wire:model='bloodType.verified' class="py-1 rounded border-zinc-300" name="" id="">
                            <option value="">Selecciona una opción</option>
                            <option value="verified">Verificado</option>
                            <option value="no_verified">No verificado</option>
                        </select>
                    </div>
                </div>
    
                <div class="flex gap-5 mt-8">
                    <h4>Alimentación/Dieta</h4>
                    <x-toggle-btn-options wire:model='diet' name="diet" content="3" :labels="['Mala', 'Regular', 'Buena']" />
                </div>
    
                <div class="flex gap-5 mt-8">
                    <h4>Actividad Física</h4>
                    <x-toggle-btn-options wire:model='physicalActivity' name="physicalActivity" content="3" :labels="['Mala', 'Regular', 'Buena']" />
                </div>
    
                <div class="flex gap-5 mt-8">
                    <h4>Higiene</h4>
                    <x-toggle-btn-options wire:model='hygiene' name="hygiene" content="3" :labels="['Mala', 'Regular', 'Buena']" />
                </div>
    
                <div>
                    <div class="flex gap-5 mt-8">
                        <h4>Tabaco</h4>
                        <x-toggle-btn-options wire:model='smoke.smoke' name="smoke" content="2" :labels="['Si', 'No']" />
                        <div class="flex items-center gap-2">
                            <label for="ex-smoker">Ex-fumador</label>
                            <input wire:model='smoke.isSmoker' type="checkbox" id="ex-smoker" value="ex-smoker" class="border-none bg-gray-300">
                        </div>
                    </div>
                    
                    <div class="mt-2">
                        <input wire:model='smoke.observations' type="text" class="py-1 rounded border-zinc-300 w-full" placeholder="Observaciones">
                    </div>
                </div>
    
                <div>
                    <div class="flex gap-5 mt-8">
                        <h4>Alcohol</h4>
                        <x-toggle-btn-options wire:model='alcohol.drink' name="alcohol" content="2" :labels="['Si', 'No']" />
                        <div class="flex items-center gap-2">
                            <label for="ex-drinker">Ex-alcoholico</label>
                            <input wire:model='alcohol.isDrinker' type="radio" id="ex-drinker" value="ex-drinker" class="border-none bg-gray-300">
                        </div>
                    </div>
                    
                    <div class="mt-2">
                        <input wire:model='alcohol.observations' type="text" class="py-1 rounded border-zinc-300 w-full" placeholder="Observaciones">
                    </div>
                </div>
    
                <div>
                    <div class="flex gap-5 mt-8">
                        <h4>Toxicomanías</h4>
                        <x-toggle-btn-options wire:model='drugs.addict' name="drugs" content="2" :labels="['Si', 'No']" />
                        <div class="flex items-center gap-2">
                            <label for="ex-drugAddict">Ex-adicto</label>
                            <input wire:model='drugs.isDrugAddict' type="radio" id="ex-drugAddict" value="ex-drugAddict" class="border-none bg-gray-300">
                        </div>
                    </div>
                    
                    <div class="mt-2">
                        <input wire:model='drugs.observations' type="text" class="py-1 rounded border-zinc-300 w-full" placeholder="Observaciones">
                    </div>
                </div>
    
                <div class="flex gap-5 mt-8">
                    <label for="housingType">Tipo de vivienda</label>
                    <select wire:model='housingType' class="py-1 rounded border-zinc-300 w-full" name="housingType" id="housingType">
                        <option value="">Selecciona una opción</option>
                        <option value="concrete">Concreto</option>
                        <option value="wood">Madera</option>
                        <option value="cardboard">Cartón</option>
                    </select>
                </div>
    
                <div class="flex gap-5 mt-8">
                    <h4>Zona Geográfica</h4>
                    <select wire:model='geographicalArea' class="py-1 rounded border-zinc-300 w-full">
                        <option value="">Seleccione una opción</option>
                        <option value="urban">Urbana</option>
                        <option value="rural">Rural</option>
                    </select>
                </div>
    
                <div class="flex gap-5 mt-8">
                    <h4>Nivel Socioeconómico</h4>
                    <select wire:model='socioeconomicLevel' class="py-1 rounded border-zinc-300 w-full">
                        <option value="">Seleccione una opción</option>
                        <option value="veryLow">Muy baja</option>
                        <option value="low">Baja</option>
                        <option value="medium">Media</option>
                        <option value="mediumHigh">Media Alta</option>
                        <option value="hight">Alta</option>
                    </select>
                </div>
    
                <div class="flex gap-5 mt-8">
                    <h4>Servicios</h4>
                    <div class="flex gap-2">
                        <x-toggle-btn wire:model='services.light' name="servicios-luz" />
                        <p>Luz</p>
                    </div>
                    <div class="flex gap-2">
                        <x-toggle-btn wire:model='services.water' name="servicios-agua" />
                        <p>Agua</p>
                    </div>
                    <div class="flex gap-2">
                        <x-toggle-btn wire:model='services.drainage' name="servicios-drenaje" />
                        <p>Drenaje</p>
                    </div>
                </div>
    
                <div class="flex items-center gap-5 mt-8">
                    <h4>Fauna</h4>
    
                    <x-toggle-btn-options wire:model='fauna.fauna' name="fauna" content="2" :labels="['Si', 'No']" />
    
                    <div>
                        <input wire:model='fauna.observations' type="text" class="border-zinc-300 py-1" placeholder="Observaciones">
                    </div>
                </div>
    
                <div class="flex items-center gap-5 mt-8">
                    <h4>Promiscuidad</h4>
    
                    <x-toggle-btn-options wire:model='promiscuity.promiscuity' name="promiscuity" content="2" :labels="['Si', 'No']" />
    
                    <div>
                        <input wire:model='promiscuity.observations' type="text" class="border-zinc-300 py-1 rounded" placeholder="Observaciones">
                    </div>
                </div>
    
                <div class="flex items-center gap-5 mt-8">
                    <h4>Hacinamiento</h4>
    
                    <x-toggle-btn-options wire:model='overcrowding.overcrowding' name="overcrowding" content="2" :labels="['Si', 'No']" />
    
                    <div>
                        <input wire:model='overcrowding.observations' type="text" class="border-zinc-300 py-1 rounded" placeholder="Observaciones">
                    </div>
                </div>
    
                <div class="flex items-center gap-5 mt-8">
                    <h4>Inmunizaciones</h4>
    
                    <select wire:model='immunizations.status' name="" id="" class="border-zinc-300 py-1 rounded">
                        <option value="">Seleccione una opción</option>
                        <option value="complete">Completas</option>
                        <option value="incomplete">Incompletas</option>
                    </select>
    
                    <input wire:model='immunizations.observations' type="text" class="border-zinc-300 py-1 rounded" placeholder="Observaciones">
                </div>
            </section>
        </article>
    
        <div class="flex justify-end gap-3 mt-10">
            <button wire:click.prevent='previous' class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Anterior
            </button>
    
            <button wire:click.prevent='next' class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Siguiente
            </button>
    
            <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Guardar
            </button>
        </div>
    </form>
</div>

@script
<script>
    $wire.on('previous-section', () => {
        setTimeout(() => {
            window.location.href = '/dashboard/expedientes/{{$patient['id']}}/medical-record/pathological-history';
        }, 2000);
    });

    $wire.on('next-section', () => {
        setTimeout(() => {
            window.location.href = '/dashboard/expedientes/{{$patient['id']}}/medical-record/physical_examination';
        }, 2000);
    });
</script>
@endscript