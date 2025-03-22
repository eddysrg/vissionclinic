<fieldset>
    <div class="flex items-center gap-3">
        <legend class="text-[#174075] text-xl py-5">Signos vitales</legend>
        <div>
            <label for="fasting_patient" class="text-xs">Paciente en ayuno</label>
            <input type="checkbox" class="rounded-full border-none bg-gray-300" id="fasting_patient" wire:model="form.fasting_patient">
        </div>
    </div>

    <section class="grid grid-cols-3 gap-5">
        <div>
            <label for="weight" class="uppercase text-xs">Peso</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.weight' type="text" id="weight" placeholder="Ej: 70">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">Kg</span>
            </div>
            @error('form.weight')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="height" class="uppercase text-xs">Talla</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.height' type="text" id="height" placeholder="Ej: 1.80">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">m</span>
            </div>
            @error('form.height')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="imc" class="uppercase text-xs">IMC</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full bg-gray-100" wire:model='form.imc' type="text" id="imc" placeholder="Ingrese peso y talla" disabled>
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">kg/m²</span>
            </div>
            @error('form.imc')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="icc" class="uppercase text-xs">ICC</label>
            <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.icc' type="text" id="icc">
            @error('form.icc')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="heartRate" class="uppercase text-xs">Frec. Cardíaca</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.frecuencia_cardiaca' type="text" id="heartRate">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">lpm</span>
            </div>
            @error('form.frecuencia_cardiaca')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="respiratoryRate" class="uppercase text-xs">Frec. Respiratoria</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.frecuencia_respiratoria' type="text" id="respiratoryRate">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">rpm</span>

            </div>
            @error('form.frecuencia_respiratoria')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="temperature" class="uppercase text-xs">Temperatura</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.temperatura' type="text" id="temperature">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">°C</span>
            </div>
            @error('form.temperatura')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="glycemia" class="uppercase text-xs">Glucemia</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.glucemia' type="text" id="glycemia">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">mg/dL</span>

            </div>
            @error('form.glucemia')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="bloodPressure" class="uppercase text-xs">Tensión Arterial</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.presion_arterial' type="text" id="bloodPressure">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">mmHg</span>
            </div>
            @error('form.presion_arterial')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="oxygenSaturation" class="uppercase text-xs">Saturación de oxígeno</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.saturacion_oxigeno' type="text" id="oxygenSaturation">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">%</span>
            </div>
            @error('form.saturacion_oxigeno')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </section>
</fieldset>
