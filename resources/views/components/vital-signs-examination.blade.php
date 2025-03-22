<fieldset>
    <legend class="text-[#174075] text-2xl mb-5">Signos vitales</legend>

    <section class="grid grid-cols-3 gap-5">
        <div>
            <label for="weight" class="uppercase text-xs">Peso</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.weight' type="text" id="weight" placeholder="Ej: 70">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">Kg</span>
            </div>
        </div>

        <div>
            <label for="height" class="uppercase text-xs">Talla</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.height' type="text" id="height" placeholder="Ej: 1.80">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">m</span>
            </div>
        </div>

        <div>
            <label for="imc" class="uppercase text-xs">IMC</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full bg-gray-100" wire:model='form.imc' type="text" id="imc" placeholder="Ingrese peso y talla" disabled>
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">kg/m²</span>
            </div>
        </div>

        <div>
            <label for="icc" class="uppercase text-xs">ICC</label>
            <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.icc' type="text" id="icc">
        </div>

        <div>
            <label for="heartRate" class="uppercase text-xs">Frec. Cardíaca</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.frecuencia_cardiaca' type="text" id="heartRate">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">lpm</span>
            </div>
        </div>

        <div>
            <label for="respiratoryRate" class="uppercase text-xs">Frec. Respiratoria</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.frecuencia_respiratoria' type="text" id="respiratoryRate">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">rpm</span>

            </div>
        </div>

        <div>
            <label for="temperature" class="uppercase text-xs">Temperatura</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.temperatura' type="text" id="temperature">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">°C</span>
            </div>
        </div>

        <div>
            <label for="glycemia" class="uppercase text-xs">Glucemia</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.glucemia' type="text" id="glycemia">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">mg/dL</span>

            </div>
        </div>

        <div>
            <label for="bloodPressure" class="uppercase text-xs">Tensión Arterial</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.presion_arterial' type="text" id="bloodPressure">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">mmHg</span>
            </div>
        </div>

        <div>
            <label for="oxygenSaturation" class="uppercase text-xs">Saturación de oxígeno</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.saturacion_oxigeno' type="text" id="oxygenSaturation">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">%</span>
            </div>
        </div>
    </section>
</fieldset>
