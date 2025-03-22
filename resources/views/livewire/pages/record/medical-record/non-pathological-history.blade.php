<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\{Patient};
use App\Livewire\Forms\NonPathologicalHistoryForm;
use Illuminate\View\View;


new
#[Layout('components.layout.record')]
#[Title('Antecedentes No Patológicos - Vission Clinic ECE')]
class extends Component {

    public $patient;
    public NonPathologicalHistoryForm $form;

    public function save()
    {
        $this->form->store();

        $route = route('dashboard.record.non-pathological-history', ['id' => $this->patient->id]);

        $this->dispatch('show-noti', message: 'Antecedentes guardados correctamente', link: $route);
    }

    public function next()
    {
        $this->form->store();

        $route = route('dashboard.record.physical-examination', ['id' => $this->patient->id]);

        $this->dispatch('show-noti', message: 'Antecedentes guardados correctamente', link: $route);
    }

    public function previous()
    {
        $this->form->store();

        $route = route('dashboard.record.pathological-history', ['id' => $this->patient->id]);

        $this->dispatch('show-noti', message: 'Antecedentes guardados correctamente', link: $route);
    }

    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
        $this->form->medicalRecordId = $this->patient->load('record.medicalRecord')->record->medicalRecord->id;
        $this->form->setData();
    }

    public function rendering(View $view)
    {
        $view
            ->layout('components.layout.record', [
                'patient' => $this->patient,
                'hasAppointment' => !$this->patient->appointments->isEmpty(),
            ]);
    }
}; ?>

<div>
    <x-slot:patientID>
        {{$this->patient->id}}
    </x-slot>

    <x-record-notification />

    <h2 class="text-3xl text-[#174075]">Antecedentes No Patológicos</h2>

    @if ($errors->any())
        <div class="mt-5 bg-red-200 border border-red-500 p-2 text-red-500 text-center">
            Debe llenar todos los campos del formulario.
        </div>
    @endif

    <form wire:submit='save'>
        <article class="grid gap-5 mt-10">
            <section>
                <div class="flex items-center gap-3">
                    <div>
                        <label for="bloodType">Tipo de sangre</label>
                        <input type="text" class="py-1 rounded border-zinc-300" id="bloodType" wire:model="form.blood_type" placeholder="Ejemplo: O+">
                    </div>
                </div>

                <div class="flex gap-5 mt-8">
                    <h4>Alimentación/Dieta</h4>
                    <x-toggle-btn-options wire:model='form.feeding' name="diet" content="3" :labels="['Mala', 'Regular', 'Buena']" />
                </div>

                <div class="flex gap-5 mt-8">
                    <h4>Actividad Física</h4>
                    <x-toggle-btn-options wire:model='form.physical_activity' name="physicalActivity" content="3" :labels="['Mala', 'Regular', 'Buena']" />
                </div>

                <div class="flex gap-5 mt-8">
                    <h4>Higiene</h4>
                    <x-toggle-btn-options wire:model='form.hygiene' name="hygiene" content="3" :labels="['Mala', 'Regular', 'Buena']" />
                </div>

                <div>
                    <div class="flex gap-5 mt-8">
                        <h4>Tabaco</h4>
                        <x-toggle-btn-options wire:model='form.tobacco' name="smoke" content="2" :labels="['Si', 'No']" />
                        <div class="flex items-center gap-2">
                            <label for="ex-smoker">Ex-fumador</label>
                            <input wire:model='form.ex_smoker' type="checkbox" id="ex-smoker" class="border-none bg-gray-300">
                        </div>
                    </div>

                    <div class="mt-2">
                        <input wire:model='form.smoker_observations' type="text" class="py-1 rounded border-zinc-300 w-full" placeholder="Observaciones">
                    </div>
                </div>

                <div>
                    <div class="flex gap-5 mt-8">
                        <h4>Alcohol</h4>
                        <x-toggle-btn-options wire:model='form.alcohol' name="alcohol" content="2" :labels="['Si', 'No']" />
                        <div class="flex items-center gap-2">
                            <label for="ex-drinker">Ex-alcoholico</label>
                            <input wire:model='form.ex_alcoholic' type="checkbox" id="ex-drinker" class="border-none bg-gray-300">
                        </div>
                    </div>

                    <div class="mt-2">
                        <input wire:model='form.alcoholic_observations' type="text" class="py-1 rounded border-zinc-300 w-full" placeholder="Observaciones">
                    </div>
                </div>

                <div>
                    <div class="flex gap-5 mt-8">
                        <h4>Toxicomanías</h4>
                        <x-toggle-btn-options wire:model='form.drug_addiction' name="drugs" content="2" :labels="['Si', 'No']" />
                        <div class="flex items-center gap-2">
                            <label for="ex-drugAddict">Ex-adicto</label>
                            <input wire:model='form.ex_drug_addict' type="checkbox" id="ex-drugAddict" class="border-none bg-gray-300">
                        </div>
                    </div>

                    <div class="mt-2">
                        <input wire:model='form.drug_addiction_observations' type="text" class="py-1 rounded border-zinc-300 w-full" placeholder="Observaciones">
                    </div>
                </div>

                <div class="flex gap-5 mt-8">
                    <label for="housingType">Tipo de vivienda</label>
                    <select wire:model='form.type_of_housing' class="py-1 rounded border-zinc-300 w-full" name="housingType" id="housingType">
                        <option value="">Selecciona una opción</option>
                        <option value="concrete">Concreto</option>
                        <option value="wood">Madera</option>
                        <option value="cardboard">Cartón</option>
                    </select>
                </div>

                <div class="flex gap-5 mt-8">
                    <h4>Zona Geográfica</h4>
                    <select wire:model='form.geographical_area' class="py-1 rounded border-zinc-300 w-full">
                        <option value="">Seleccione una opción</option>
                        <option value="urban">Urbana</option>
                        <option value="rural">Rural</option>
                    </select>
                </div>

                <div class="flex gap-5 mt-8">
                    <h4>Nivel Socioeconómico</h4>
                    <select wire:model='form.socioeconomic_level' class="py-1 rounded border-zinc-300 w-full">
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
                        <x-toggle-btn wire:model='form.electricity_service' name="servicios-luz" />
                        <p>Luz</p>
                    </div>
                    <div class="flex gap-2">
                        <x-toggle-btn wire:model='form.water_service' name="servicios-agua" />
                        <p>Agua</p>
                    </div>
                    <div class="flex gap-2">
                        <x-toggle-btn wire:model='form.drainage_service' name="servicios-drenaje" />
                        <p>Drenaje</p>
                    </div>
                </div>

                <div class="flex items-center gap-5 mt-8">
                    <h4>Fauna</h4>

                    <x-toggle-btn-options wire:model='form.fauna' name="fauna" content="2" :labels="['Si', 'No']" />

                    <div>
                        <input wire:model='form.fauna_observations' type="text" class="border-zinc-300 py-1" placeholder="Observaciones">
                    </div>
                </div>

                <div class="flex items-center gap-5 mt-8">
                    <h4>Promiscuidad</h4>

                    <x-toggle-btn-options wire:model='form.promiscuity' name="promiscuity" content="2" :labels="['Si', 'No']" />

                    <div>
                        <input wire:model='form.promiscuity_observations' type="text" class="border-zinc-300 py-1 rounded" placeholder="Observaciones">
                    </div>
                </div>

                <div class="flex items-center gap-5 mt-8">
                    <h4>Hacinamiento</h4>

                    <x-toggle-btn-options wire:model='form.overcrowding' name="overcrowding" content="2" :labels="['Si', 'No']" />

                    <div>
                        <input wire:model='form.overcrowding_observations' type="text" class="border-zinc-300 py-1 rounded" placeholder="Observaciones">
                    </div>
                </div>

                <div class="flex items-center gap-5 mt-8">
                    <h4>Inmunizaciones</h4>

                    <select wire:model='form.immunizations' class="border-zinc-300 py-1 rounded">
                        <option value="">Seleccione una opción</option>
                        <option value="complete">Completas</option>
                        <option value="incomplete">Incompletas</option>
                    </select>

                    <input wire:model='form.immunization_observations' type="text" class="border-zinc-300 py-1 rounded" placeholder="Observaciones">
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
