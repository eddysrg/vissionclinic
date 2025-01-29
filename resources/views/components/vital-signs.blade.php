<fieldset>
    <div class="flex items-center gap-3 my-3">
        <legend class="text-[#174075] text-xl">Signos vitales</legend>
        <span class="text-sm">
            <label for="patientFasting">Paciente en Ayuno</label>
            <input wire:model='form.patientFasting' type="checkbox" id="patientFasting" class="rounded-full border-none bg-gray-400">
        </span>
    </div>

    <section class="grid grid-cols-4 gap-5">
        <div class="flex flex-col">
            <label for="weight" class="uppercase text-xs">Peso</label>
            <input class="text-sm rounded border-zinc-400" wire:model='form.weight' type="number" id="weight" placeholder="Ej: 70">
            @error('form.weight') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="flex flex-col">
            <label for="height" class="uppercase text-xs">Talla</label>
            <input class="text-sm rounded border-zinc-400" wire:model='form.height' type="number" step="0.01" min="0" maxlength="2" id="height" placeholder="0.00">
            @error('form.height') 
                    <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="flex flex-col">
            <label for="imc" class="uppercase text-xs">IMC</label>
            <input class="text-sm rounded border-zinc-400 bg-gray-100" wire:model='form.imc' type="number" id="imc" disabled placeholder="Ingrese peso y talla">
            @error('form.imc') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="flex flex-col">
            <label for="icc" class="uppercase text-xs">ICC</label>
            <input class="text-sm rounded border-zinc-400" wire:model='form.icc' type="text" id="icc">
            @error('form.icc') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="flex flex-col">
            <label for="heartRate" class="uppercase text-xs">Frec. Cardíaca</label>
            <input class="text-sm rounded border-zinc-400" wire:model='form.heartRate' type="text" id="heartRate">
            @error('form.heartRate') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="flex flex-col">
            <label for="respiratoryRate" class="uppercase text-xs">Frec. Respiratoria</label>
            <input class="text-sm rounded border-zinc-400" wire:model='form.respiratoryRate' type="text" id="respiratoryRate">
            @error('form.respiratoryRate') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="flex flex-col">
            <label for="temperature" class="uppercase text-xs">Temperatura</label>
            <input class="text-sm rounded border-zinc-400" wire:model='form.temperature' type="text" id="temperature">
            @error('form.temperature') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="flex flex-col">
            <label for="glycemia" class="uppercase text-xs">Glucemia</label>
            <input class="text-sm rounded border-zinc-400" wire:model='form.glycemia' type="text" id="glycemia">
            @error('form.glycemia') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="flex flex-col">
            <label for="bloodPressure" class="uppercase text-xs">Tensión Arterial</label>
            <input class="text-sm rounded border-zinc-400" wire:model='form.bloodPressure' type="text" id="bloodPressure">
            @error('form.bloodPressure') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="flex flex-col">
            <label for="oxygenSaturation" class="uppercase text-xs">Saturación de oxígeno</label>
            <input class="text-sm rounded border-zinc-400" wire:model='form.oxygenSaturation' type="text" id="oxygenSaturation">
            @error('form.oxygenSaturation') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </section>
</fieldset>