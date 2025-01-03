@props(['name'])

<div class="flex justify-center items-center">
    <input {{$attributes->merge(['wire:model' => $attributes->get('wire:model')])}} class="toggle-input"
    type="checkbox" id="{{$name}}">
    <label class="toggle-button" for="{{$name}}"></label>
</div>