<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};

new
#[Layout('layouts.website')]
class extends Component {
    public array $maternalGrandmotherData = [
        'relative' => 'Abuela',
        'finado' => false
    ];
    public array $maternalGrandfatherData = [];
    public array $motherData = [];
    public array $maternalOtherData = [];
    public array $paternalGrandmotherData = [];
    public array $paternalGrandfatherData = [];
    public array $fatherData = [];
    public array $paternalOtherData = [];

    public function save()
    {
        dd($this->maternalGrandmotherData);
    }
}; ?>

<form wire:submit="save" class="p-8">
    <p class="mb-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid magnam natus quae quaerat quia.
        Ad, aliquid corporis dignissimos exercitationem fuga in officia provident quam ratione rem repellat tempore vel
        voluptatem.</p>

    <table class="w-full border-collapse">
        <thead class="bg-gray-300">
            <tr>
                <th class="p-2 uppercase text-sm">Maternos</th>
                <th class="p-2 uppercase text-sm">Finado</th>
                <th class="p-2 uppercase text-sm">Hta</th>
                <th class="p-2 uppercase text-sm">Dm</th>
                <th class="p-2 uppercase text-sm">Neoplasias</th>
                <th class="p-2 uppercase text-sm">Cardiopatías</th>
                <th class="p-2 uppercase text-sm">Oftalmológicas</th>
                <th class="p-2 uppercase text-sm">Psiquátricas</th>
                <th class="p-2 uppercase text-sm">Neurológicas</th>
                <th class="p-2 uppercase text-sm">Otro</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="p-2 text-center bg-red-200">
                    <input type="text" wire:model="maternalGrandmotherData.relative" id="abuela">
                </td>
                <td class="p-2 text-center bg-red-200"><input type="checkbox" wire:model="maternalGrandmotherData.finado"></td>
                <td class="p-2 text-center bg-red-200"><input type="checkbox" value="HTA" wire:model="maternalGrandmotherData"></td>
                <td class="p-2 text-center bg-red-200"><input type="checkbox" value="DM" wire:model="maternalGrandmotherData"></td>
                <td class="p-2 text-center bg-red-200"><input type="checkbox" value="Neoplasias" wire:model="maternalGrandmotherData"></td>
                <td class="p-2 text-center bg-red-200"><input type="checkbox" value="Cardiopatías" wire:model="maternalGrandmotherData"></td>
                <td class="p-2 text-center bg-red-200"><input type="checkbox" value="Oftalmológicas" wire:model="maternalGrandmotherData"></td>
                <td class="p-2 text-center bg-red-200"><input type="checkbox" value="Psiquátricas" wire:model="maternalGrandmotherData"></td>
                <td class="p-2 text-center bg-red-200"><input type="checkbox" value="Neurológicas" wire:model="maternalGrandmotherData"></td>
                <td class="p-2 text-center bg-red-200"><input type="checkbox" value="Otro" wire:model="maternalGrandmotherData"></td>
            </tr>
        </tbody>
    </table>

    <button type="submit">Enviar</button>
</form>
