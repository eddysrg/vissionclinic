@props(['name'])

<div class="flex justify-center items-center">
    <input class="togggle-input" type="checkbox" id="{{$name}}">
    <label class="toggle-button" for="{{$name}}"></label>
</div>