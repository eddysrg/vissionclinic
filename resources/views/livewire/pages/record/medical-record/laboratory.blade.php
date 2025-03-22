<?php

use Livewire\Volt\Component;
use Carbon\Carbon;
use Livewire\Attributes\{Layout, Title};
use App\Livewire\Forms\LaboratoryForm;
use App\Models\Patient;
use Illuminate\View\View;


new
#[Title('Laboratorio - Vission Clinic ECE')]
class extends Component {
    public $patient;
    public LaboratoryForm $form;

    public function save()
    {
        $this->form->store();
        $this->dispatch('show-notification', message: 'Registro de Laboratorio guardado con éxito');

    }

    public function medicalConsultation()
    {
        redirect()->route('dashboard.record.medical-consultation', ['id' => $this->patient->id]);
    }

    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
        $this->form->date = Carbon::now()->format('Y-m-d');
        $this->form->time = Carbon::now()->format('H:i');
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

    <x-record-notification/>

    <h2 class="text-3xl text-[#174075]">Laboratorio</h2>

    <form wire:submit='save'>
        <fieldset class="mt-8 grid grid-cols-4 gap-5">
            <div class="flex flex-col">
                <label for="date" class="uppercase text-xs">Fecha</label>
                <input type="date" wire:model='form.date' id="date" class="text-sm rounded border-zinc-400 py-1">
                @error('form.date')
                    <span class="text-sm text-red-500">{{$message}}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="time" class="uppercase text-xs">Hora</label>
                <input type="time" wire:model='form.time' id="time" class="text-sm rounded border-zinc-400 py-1">
                @error('form.time')
                    <span class="text-sm text-red-500">{{$message}}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="urgent" class="uppercase text-xs">Servicio</label>
                <select wire:model='form.service' id="service" class="text-sm rounded border-zinc-400 py-1">
                    <option value="">Selecciona una opción</option>
                    <option value="hematologia">Hematología</option>
                    <option value="coagulacion">Coagulación</option>
                    <option value="quimica_clinica">Química Clínica</option>
                    <option value="inmunologia">Inmunología</option>
                    <option value="citologia">Citología</option>
                    <option value="urologia_coprologia">Urología y Coprología</option>
                    <option value="microbiologia">Microbiología</option>
                </select>
                @error('form.service')
                    <span class="text-sm text-red-500">{{$message}}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="urgent" class="uppercase text-xs">¿Urgente?</label>
                <select wire:model='form.isUrgent' id="urgent" class="text-sm rounded border-zinc-400 py-1">
                    <option value="">Selecciona una opción</option>
                    <option value="si">Si</option>
                    <option value="no">no</option>
                </select>
                @error('form.isUrgent')
                    <span class="text-sm text-red-500">{{$message}}</span>
                @enderror
            </div>

            <div class="flex flex-col col-span-2">
                <label for="sampleType" class="uppercase text-xs">Tipo de muestra</label>
                <select wire:model='form.sampleType' id="sampleType" class="text-sm rounded border-zinc-400 py-1">
                    <option value="">Selecciona una opción</option>
                    <option value="sangre">Sangre</option>
                    <option value="orina">Orina</option>
                    <option value="heces">Heces</option>
                    <option value="saliva">Saliva</option>
                    <option value="tejido">Tejido</option>
                    <option value="liquido_cefalorraquideo">Líquido cefalorraquídeo</option>
                    <option value="liquido_sinovial">Líquido sinovial</option>
                    <option value="liquido_pleural">Líquido pleural</option>
                    <option value="liquido_pericardico">Líquido pericárdico</option>
                    <option value="esputo">Esputo</option>
                    <option value="secrecion_vaginal">Secreción vaginal</option>
                    <option value="liquido_seminal">Líquido seminal</option>
                </select>
                @error('form.sampleType')
                    <span class="text-sm text-red-500">{{$message}}</span>
                @enderror
            </div>
        </fieldset>

        <fieldset class="mt-8">
            <legend class="text-[#174075] text-xl mb-4">Diagnóstico</legend>
            <textarea wire:model='form.diagnosis' id="diagnosis" rows="4" class="w-full rounded border-zinc-400"></textarea>
            @error('form.diagnosis')
                    <span class="text-sm text-red-500">{{$message}}</span>
            @enderror

            <ul class="space-y-2">
                <li x-data="{ open: false }" class="">
                    <div @click="open = !open" class="flex gap-5 bg-[#859EB9] text-[#0E2F5E] p-3 rounded">
                        <h4>1. Hematología</h4>
                        <span>(Selecciona)</span>
                    </div>

                    <section
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-[-10px]"
                    class="px-2 py-4 grid grid-cols-3 gap-8">
                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="biometria_hematica_froja" value="biometriaHematicaFroja" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="biometria_hematica_froja" class="uppercase text-sm cursor-pointer">Biometria Hematica - F.roja</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="gota_gruesa" value="gotaGruesa" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="gota_gruesa" class="uppercase text-sm cursor-pointer">Gota gruesa</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="celulas_le" value="celulasLE" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="celulas_le" class="uppercase text-sm cursor-pointer">Celulas LE</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="biometria_hematica_fblanca" value="biometriaHematicaFblanca" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="biometria_hematica_fblanca" class="uppercase text-sm cursor-pointer">Biometria Hematica - F.blanca</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="recuento_plaquetas" value="recuentoPlaquetas" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="recuento_plaquetas" class="uppercase text-sm cursor-pointer">Recuento de plaquetas</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="eosinotilos_moco_nasal" value="eosinotilosMocoNasal" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="eosinotilos_moco_nasal" class="uppercase text-sm cursor-pointer">Eosinotilos en moco nasal</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="busqueda_plasmodio" value="busquedaPlasmodio" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="busqueda_plasmodio" class="uppercase text-sm cursor-pointer">Busqueda de plasmodio</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="reticulocitos" value="reticulocitos" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="reticulocitos" class="uppercase text-sm cursor-pointer">Reticulocitos</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="grupo_sanguineo_factor_rh" value="grupoSanguineoFactorRH" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="grupo_sanguineo_factor_rh" class="uppercase text-sm cursor-pointer">Grupo sanguineo y factor RH</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.hematology' id="vsg" value="vsg" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="vsg" class="uppercase text-sm cursor-pointer">VSG</label>
                        </div>
                    </section>
                </li>

                <li x-data="{ open: false }" class="">
                    <div @click="open = !open" class="flex gap-5 bg-[#859EB9] text-[#0E2F5E] p-3 rounded">
                        <h4>2. Coagulación</h4>
                        <span>(Selecciona)</span>
                    </div>

                    <section
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-[-10px]"
                    class="px-2 py-4 grid grid-cols-3 gap-8">
                        <div>
                            <input type="checkbox" wire:model='form.coagulation' id="tiempo_de_protrombina" value="tiempoDeProtrombina" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="tiempo_de_protrombina" class="uppercase text-sm cursor-pointer">Tiempo de protrombina</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.coagulation' id="tiempo_de_tromboplastina" value="tiempoDeTromboplastina" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="tiempo_de_tromboplastina" class="uppercase text-sm cursor-pointer">Tiempo de tromboplastina</label>
                        </div>
                    </section>
                </li>

                <li x-data="{ open: false }" class="">
                    <div @click="open = !open" class="flex gap-5 bg-[#859EB9] text-[#0E2F5E] p-3 rounded">
                        <h4>3. Química Clínica</h4>
                        <span>(Selecciona)</span>
                    </div>

                    <section
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-[-10px]"
                    class="px-2 py-4 grid grid-cols-3 gap-8">
                        @php
                            $clinicalChemistryList = [
                                0 => [ 'id' => 'glucosa', 'name' => 'Glucosa' ],
                                1 => [ 'id' => 'nitrogeno_u_bun', 'name' => 'Nitogreno U.(Bun)' ],
                                2 => [ 'id' => 'urea', 'name' => 'Urea' ],
                                3 => [ 'id' => 'creatinina', 'name' => 'Creatinina' ],
                                4 => [ 'id' => 'acido_urico', 'name' => 'Acido. Urico' ],
                                5 => [ 'id' => 'trigliceridos', 'name' => 'Triglicéridos' ],
                                6 => [ 'id' => 'colesterol_total', 'name' => 'Colesterol total' ],
                                7 => [ 'id' => 'colesterol_hdl', 'name' => 'Colesterol HDL' ],
                                8 => [ 'id' => 'colesterol_ldl', 'name' => 'Colesterol LDL' ],
                                9 => [ 'id' => 'colesterol_vldl', 'name' => 'Colesterol VLDL' ],
                                10 => [ 'id' => 'bilirubina_total', 'name' => 'Bilirubina total' ],
                                11 => [ 'id' => 'bilirubina_completa', 'name' => 'Bilirubina Directa' ],
                                12 => [ 'id' => 'bilirubina_indirecta', 'name' => 'Bilirubina Indirecta' ],
                                13 => [ 'id' => 'transaminasa_ast', 'name' => 'Transaminasa AST' ],
                                14 => [ 'id' => 'transaminasa_alt', 'name' => 'Transaminasa ALT' ],
                                15 => [ 'id' => 'fosfatasa_alcalina', 'name' => 'Fosfatasa Alcalina' ],
                                16 => [ 'id' => 'proteinas_totales', 'name' => 'Proteinas totales' ],
                                17 => [ 'id' => 'albumina', 'name' => 'Albúmina' ],
                                18 => [ 'id' => 'globulina', 'name' => 'Globulina' ],
                                19 => [ 'id' => 'relacion_ag', 'name' => 'Relación AG' ],
                                20 => [ 'id' => 'sodio', 'name' => 'Sodio' ],
                                21 => [ 'id' => 'potasio', 'name' => 'Potasio' ],
                                22 => [ 'id' => 'cloro', 'name' => 'Cloro' ],
                                23 => [ 'id' => 'calcio', 'name' => 'Calcio' ],
                                24 => [ 'id' => 'fosforo', 'name' => 'Fósforo' ],
                                25 => [ 'id' => 'magnesio', 'name' => 'Magnesio' ],
                                26 => [ 'id' => 'amilasa', 'name' => 'Amilasa' ],
                                27 => [ 'id' => 'lipasa', 'name' => 'Lipasa' ],
                                28 => [ 'id' => 'dhl', 'name' => 'DHL' ],
                                29 => [ 'id' => 'ck', 'name' => 'CK' ],
                                30 => [ 'id' => 'ck_mb', 'name' => 'CK-MB' ],
                                31 => [ 'id' => 'ggt', 'name' => 'GGT' ],
                                32 => [ 'id' => 'gasometria', 'name' => 'Gasometría' ],
                                33 => [ 'id' => 'hb_glicosilada', 'name' => 'HB Glicosilada' ],
                                34 => [ 'id' => 'curva_tol_a _la_glucosa', 'name' => 'Curva Tol. A la glucosa' ],
                            ];
                        @endphp

                        @foreach ($clinicalChemistryList as $item)
                            <div>
                                <input type="checkbox" wire:model='form.clinicalChemistry' id="{{$item['id']}}" value="{{$item['id']}}" class="rounded-full bg-gray-300 border-none cursor-pointer">
                                <label for="{{$item['id']}}" class="uppercase text-sm cursor-pointer">{{$item['name']}}</label>
                            </div>
                        @endforeach
                    </section>
                </li>

                <li x-data="{ open: false }" class="">
                    <div @click="open = !open" class="flex gap-5 bg-[#859EB9] text-[#0E2F5E] p-3 rounded">
                        <h4>4. Inmunología</h4>
                        <span>(Selecciona)</span>
                    </div>

                    <section
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-[-10px]"
                    class="px-2 py-4 grid grid-cols-3 gap-8">
                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="antiestreptolisinas" value="antiestreptolisinas" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="antiestreptolisinas" class="uppercase text-sm cursor-pointer">Antiestreptolisinas</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="antigeno_prostatico" value="antigenoProstatico" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="antigeno_prostatico" class="uppercase text-sm cursor-pointer">Antígeno Prostático</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="proteina_c_reactiva" value="proteina_c_reactiva" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="proteina_c_reactiva" class="uppercase text-sm cursor-pointer">Proteina C Reactiva</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="coombs_directo" value="coombs_directo" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="coombs_directo" class="uppercase text-sm cursor-pointer">Coombs directo</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="coombs_indirecto" value="coombs_indirecto" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="coombs_indirecto" class="uppercase text-sm cursor-pointer">Coombs indirecto</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="factor_reumatoide" value="factor_reumatoide" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="factor_reumatoide" class="uppercase text-sm cursor-pointer">Factor reumatoide</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="pie_suero" value="pie_suero" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="pie_suero" class="uppercase text-sm cursor-pointer">P.I.E Suero</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="pie_orina" value="pie_orina" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="pie_orina" class="uppercase text-sm cursor-pointer">P.I.E Orina</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="pruebas_cruzadas" value="pruebas_cruzadas" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="pruebas_cruzadas" class="uppercase text-sm cursor-pointer">Pruebas cruzadas</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="reacciones_febriles" value="reacciones_febriles" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="reacciones_febriles" class="uppercase text-sm cursor-pointer">Reacciones febriles</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="vdrl" value="vdrl" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="vdrl" class="uppercase text-sm cursor-pointer">VDRL</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="vih" value="vih" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="vih" class="uppercase text-sm cursor-pointer">VIH</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.immunology' id="rosa_bengala" value="rosa_bengala" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="rosa_bengala" class="uppercase text-sm cursor-pointer">Rosa Bengala</label>
                        </div>
                    </section>
                </li>

                <li x-data="{ open: false }" class="">
                    <div @click="open = !open" class="flex gap-5 bg-[#859EB9] text-[#0E2F5E] p-3 rounded">
                        <h4>5. Citología</h4>
                        <span>(Selecciona)</span>
                    </div>

                    <section
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-[-10px]"
                    class="px-2 py-4 grid grid-cols-3 gap-8">
                        <div>
                            <input type="checkbox" wire:model='form.cytology' id="espermatobioscopia" value="espermatobioscopia" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="espermatobioscopia" class="uppercase text-sm cursor-pointer">Espermatobioscopía</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.cytology' id="citoquimica_de" value="citoquimica_de" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="citoquimica_de" class="uppercase text-sm cursor-pointer">Citoquímica de:</label>
                        </div>
                    </section>
                </li>

                <li x-data="{ open: false }" class="">
                    <div @click="open = !open" class="flex gap-5 bg-[#859EB9] text-[#0E2F5E] p-3 rounded">
                        <h4>6. Urología y Coprología</h4>
                        <span>(Selecciona)</span>
                    </div>

                    <section
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-[-10px]"
                    class="px-2 py-4 grid grid-cols-3 gap-8">
                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="examen_general_de_orina" value="examen_general_de_orina" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="examen_general_de_orina" class="uppercase text-sm cursor-pointer">Examén General de orina</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="depuración_de_creatinina_en_orina" value="depuración_de_creatinina_en_orina" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="depuración_de_creatinina_en_orina" class="uppercase text-sm cursor-pointer">Depuración de creatinina en orina de 24 hrs</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="cuantificacion_de_proteinas_en_orina" value="cuantificacion_de_proteinas_en_orina" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="cuantificacion_de_proteinas_en_orina" class="uppercase text-sm cursor-pointer">Cuantificación de proteinas en orina de 24 hrs</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="microalbuminuria" value="microalbuminuria" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="microalbuminuria" class="uppercase text-sm cursor-pointer">Microalbuminuria</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="leucocitos_en_moco_fecal" value="leucocitos_en_moco_fecal" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="leucocitos_en_moco_fecal" class="uppercase text-sm cursor-pointer">Leucocitos en moco fecal</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="coproparasitoscopico_unico" value="coproparasitoscopico_unico" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="coproparasitoscopico_unico" class="uppercase text-sm cursor-pointer">Coproparasitoscópico unico</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="coproparasitoscopico_seriado" value="coproparasitoscopico_seriado" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="coproparasitoscopico_seriado" class="uppercase text-sm cursor-pointer">Coproparasitoscópico seriado</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="busqueda_de_amiba_en_fresco" value="busqueda_de_amiba_en_fresco" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="busqueda_de_amiba_en_fresco" class="uppercase text-sm cursor-pointer">Búsqueda de amiba en fresco</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="azucares_reductores" value="azucares_reductores" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="azucares_reductores" class="uppercase text-sm cursor-pointer">Azúcares reductores</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.urologyAndCoprology' id="sangre_oculta_heces" value="sangre_oculta_heces" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="sangre_oculta_heces" class="uppercase text-sm cursor-pointer">Sangre oculta en heces</label>
                        </div>
                    </section>
                </li>

                <li x-data="{ open: false }" class="">
                    <div @click="open = !open" class="flex gap-5 bg-[#859EB9] text-[#0E2F5E] p-3 rounded">
                        <h4>7. Microbiología</h4>
                        <span>(Selecciona)</span>
                    </div>

                    <section
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-[-10px]"
                    class="px-2 py-4 grid grid-cols-3 gap-8">
                        <div>
                            <input type="checkbox" wire:model='form.microbiology' id="exudado_vaginal" value="exudado_vaginal" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="exudado_vaginal" class="uppercase text-sm cursor-pointer">Exudado vaginal</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.microbiology' id="exudado_uretral" value="exudado_uretral" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="exudado_uretral" class="uppercase text-sm cursor-pointer">Exudado Uretral</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.microbiology' id="exudado_faringeo" value="exudado_faringeo" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="exudado_faringeo" class="uppercase text-sm cursor-pointer">Exudado Faringeo</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.microbiology' id="urocultivo" value="urocultivo" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="urocultivo" class="uppercase text-sm cursor-pointer">Urocultivo</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.microbiology' id="coprocultivo" value="coprocultivo" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="coprocultivo" class="uppercase text-sm cursor-pointer">Coprocultivo</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.microbiology' id="hemocultivo" value="hemocultivo" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="hemocultivo" class="uppercase text-sm cursor-pointer">Hemocultivo</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.microbiology' id="antibiograma" value="antibiograma" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="antibiograma" class="uppercase text-sm cursor-pointer">Antibiograma</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.microbiology' id="baar" value="baar" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="baar" class="uppercase text-sm cursor-pointer">Baar</label>
                        </div>

                        <div>
                            <input type="checkbox" wire:model='form.microbiology' id="cultivo_de" value="cultivo_de" class="rounded-full bg-gray-300 border-none cursor-pointer">
                            <label for="cultivo_de" class="uppercase text-sm cursor-pointer">Cultivo de:</label>
                        </div>
                    </section>
                </li>
            </ul>

        </fieldset>

        <fieldset class="mt-8">
            <legend class="text-[#174075] text-xl mb-4">Estudios especiales</legend>
            <textarea wire:model='form.specialStudies' id="studies" rows="2" class="w-full rounded border-zinc-400"></textarea>
            @error('form.specialStudies')
                <span class="text-sm text-red-500">{{$message}}</span>
            @enderror
        </fieldset>

        <fieldset class="mt-8 grid grid-cols-2">
            <legend class="text-[#174075] text-xl mb-4 ">Folio físico</legend>
            <input wire:model='form.folio' type="text" id="physicalFolio" class="rounded border-zinc-400 w-full">
            @error('form.folio')
                <span class="text-sm text-red-500">{{$message}}</span>
            @enderror
        </fieldset>

        <div class="flex items-center justify-end mt-8">
            <div class="flex gap-3">

                 <button type="button" wire:click='finish'  class="px-8 py-1 bg-[#41759D] text-white rounded-full flex items-center gap-2">
                    Imprimir
                </button>

                <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Guardar
                </button>

                {{-- <button wire:click.prevent='finish'  class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Finalizar consulta
                </button> --}}
            </div>
        </div>
    </form>

</div>
