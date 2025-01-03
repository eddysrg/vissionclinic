<section class="flex flex-col gap-6">
    <h3 class="text-2xl text-[#174075] my-5">Interrogatorio por aparatos y sistemas</h3>

    <section class="flex gap-5">
        <div class="flex flex-col w-full">
            <label class="text-sm uppercase" for="respiratory_system">Aparato Respiratorio</label>
            <input wire:model='testSystems.respiratory.value' type="text" id="respiratory_system" class="py-1 rounded border-zinc-300">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="respiratory_system_status_normal">Normal</label>
            <input wire:model='testSystems.respiratory.status' type="radio" name="statusRespiratory" id="respiratory_system_status_normal" value="normal" class="py-1 rounded-full bg-gray-300 border-none">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="respiratory_system_status_anormal">Anormal</label>
            <input wire:model='testSystems.respiratory.status' type="radio" name="statusRespiratory" id="respiratory_system_status_anormal" value="anormal" class="py-1 rounded_full bg-gray-300 border-none">
        </div>
    </section>

    <section class="flex gap-5">
        <div class="flex flex-col w-full">
            <label class="text-sm uppercase" for="digestive_system">Aparato Digestivo</label>
            <input wire:model='testSystems.digestive.value' type="text" id="digestive_system" class="py-1 rounded border-zinc-300">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="digestive_system_status_normal">Normal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_normal" value="normal" class="py-1 rounded-full bg-gray-300 border-none">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="digestive_system_status_anormal">Anormal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_anormal" value="anormal" class="py-1 rounded_full bg-gray-300 border-none">
        </div>
    </section>

    <section class="flex gap-5">
        <div class="flex flex-col w-full">
            <label class="text-sm uppercase" for="digestive_system">Aparato Cardiovascular</label>
            <input wire:model='oxygenSaturation' type="text" id="digestive_system" class="py-1 rounded border-zinc-300">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="digestive_system_status_normal">Normal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_normal" value="normal" class="py-1 rounded-full bg-gray-300 border-none">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="respiratory_system_status_anormal">Anormal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_anormal" value="anormal" class="py-1 rounded_full bg-gray-300 border-none">
        </div>
    </section>

    <section class="flex gap-5">
        <div class="flex flex-col w-full">
            <label class="text-sm uppercase" for="digestive_system">Aparato Genitourinario</label>
            <input wire:model='oxygenSaturation' type="text" id="digestive_system" class="py-1 rounded border-zinc-300">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="digestive_system_status_normal">Normal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_normal" value="normal" class="py-1 rounded-full bg-gray-300 border-none">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="respiratory_system_status_anormal">Anormal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_anormal" value="anormal" class="py-1 rounded_full bg-gray-300 border-none">
        </div>
    </section>

    <section class="flex gap-5">
        <div class="flex flex-col w-full">
            <label class="text-sm uppercase" for="digestive_system">Aparato Nervioso</label>
            <input wire:model='oxygenSaturation' type="text" id="digestive_system" class="py-1 rounded border-zinc-300">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="digestive_system_status_normal">Normal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_normal" value="normal" class="py-1 rounded-full bg-gray-300 border-none">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="respiratory_system_status_anormal">Anormal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_anormal" value="anormal" class="py-1 rounded_full bg-gray-300 border-none">
        </div>
    </section>

    <section class="flex gap-5">
        <div class="flex flex-col w-full">
            <label class="text-sm uppercase" for="digestive_system">Aparato Musculoesquelético</label>
            <input wire:model='oxygenSaturation' type="text" id="digestive_system" class="py-1 rounded border-zinc-300">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="digestive_system_status_normal">Normal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_normal" value="normal" class="py-1 rounded-full bg-gray-300 border-none">
        </div>

        <div class="flex items-center gap-3">
            <label class="text-sm uppercase" for="respiratory_system_status_anormal">Anormal</label>
            <input wire:model='testSystems.digestive.status' type="radio" name="statusDigestive" id="digestive_system_status_anormal" value="anormal" class="py-1 rounded_full bg-gray-300 border-none">
        </div>
    </section>
</section>