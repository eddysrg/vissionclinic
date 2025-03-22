@props([
'patient',
'size' => '14',
'fontSize' => 'text-2xl',
'classes' => 'font-medium aspect-square rounded-full flex justify-center items-center'
])

@php
if($patient->gender === 'Hombre') {
$classes.= ' bg-[#174075] text-white';
} else {
$classes.= ' bg-[#41759D40] text-[#41759D]';
}

$initials = substr($patient->name, 0, 1) . substr($patient->last_name, 0, 1);
@endphp

<div class="{{$classes}} w-{{$size}} h-{{$size}} {{$fontSize}}">
    <p>{{$initials}}</p>
</div>