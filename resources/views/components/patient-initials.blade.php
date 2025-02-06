@props([
'patient',
'size',
'classes' => 'font-medium w-9 h-9 aspect-square rounded-full flex justify-center items-center'
])

@php
if($patient->gender === 'H') {
$classes.= ' bg-[#174075] text-white';
} else {
$classes.= ' bg-[#41759D40] text-[#41759D]';
}

$initials = substr($patient->name, 0, 1) . substr($patient->father_last_name, 0, 1);
@endphp

<div class="{{$classes}}">
    <p>{{$initials}}</p>
</div>