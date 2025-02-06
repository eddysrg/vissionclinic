<fieldset>
    <div class="flex items-center gap-3 my-3">
        <legend class="text-[#174075] text-xl">Signos vitales</legend>
        <span class="text-sm">
            <label for="patientFasting">Paciente en Ayuno</label>
            <input wire:model='form.patientFasting' type="checkbox" id="patientFasting" class="rounded-full border-none bg-gray-400">
        </span>
        @error('form.patientFasting')
            <span class="text-sm text-red-500">Debe indicar si el paciente esta en ayuno</span>
        @enderror
    </div>

    <section class="grid grid-cols-4 gap-5">
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
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.heartRate' type="text" id="heartRate">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">lpm</span>
            </div>
            @error('form.heartRate') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="respiratoryRate" class="uppercase text-xs">Frec. Respiratoria</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.respiratoryRate' type="text" id="respiratoryRate">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">rpm</span>

            </div>
            @error('form.respiratoryRate') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="temperature" class="uppercase text-xs">Temperatura</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.temperature' type="text" id="temperature">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">°C</span>

            </div>
            @error('form.temperature') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="glycemia" class="uppercase text-xs">Glucemia</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.glycemia' type="text" id="glycemia">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">mg/dL</span>

            </div>
            @error('form.glycemia') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="bloodPressure" class="uppercase text-xs">Tensión Arterial</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.bloodPressure' type="text" id="bloodPressure">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">mmHg</span>

            </div>
            @error('form.bloodPressure') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="oxygenSaturation" class="uppercase text-xs">Saturación de oxígeno</label>
            <div class="relative">
                <input class="text-sm rounded border-zinc-400 w-full" wire:model='form.oxygenSaturation' type="text" id="oxygenSaturation">
                <span class="absolute border-zinc-400 border-l top-0 right-0 h-full flex items-center px-2 rounded-tr rounded-br text-sm">%</span>

            </div>
            @error('form.oxygenSaturation') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </section>
</fieldset>