<div class="bg-[#F3FCFE] px-3 pt-3">
    <div @class(['border-b'=> $border, 'flex', 'justify-between'])>
        <div class="flex items-center gap-2">
            <div class="w-5 h-5">
                <img class="w-full h-full object-contain" src="{{asset('images/' . $icon)}}" alt="{{$vitalSign}}">
            </div>
            <p class="text-sm uppercase {{$color}}">{{$vitalSign}}</p>
        </div>

        <div class="flex items-center gap-1">
            <p class="font-semibold">{{$value}}</p>
            <p class="text-xs">{{$unit}}</p>
        </div>
    </div>
</div>