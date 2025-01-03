@props(['name', 'content' => 2, 'labels'])




@for ($i = 0; $i < $content; $i++)
    <div class="flex gap-2">
        <div class="flex justify-center items-center">
            <input {{$attributes->merge(['wire:model' => $attributes->get('wire:model')])}} type="radio" class="toggle-input-options" id="tgl-btn-{{$name}}-{{$i + 1}}" name="{{$name}}" value="{{$labels[$i]}}">
            <label for="tgl-btn-{{$name}}-{{$i + 1}}" class="toggle-button-options"></label>
        </div>
        <p>{{$labels[$i]}}</p>
    </div>
@endfor