@props([
'isHeader' => false,
'classes' => '',
'name' => Auth()->user()->name,
'father_lastname' => Auth()->user()->father_lastname,
'mother_lastname' => Auth()->user()->mother_lastname,
'degree' => Auth()->user()->degree,
'gender' => Auth()->user()->gender
])

@if($isHeader)
<div class="flex justify-center items-center gap-3">
    <p>
        {{$gender === 'male' ? 'Bienvenido ' : 'Bienvenida '}}
        {{$degree . ' ' . $name . ' ' . $father_lastname . ' ' . $mother_lastname}}
    </p>
    <i class="fa-solid fa-caret-down text-white"></i>
</div>
@else
<p {{ $attributes->merge(['class' => $classes]) }}>
    {{$degree . ' ' . $name . ' ' . $father_lastname . ' ' . $mother_lastname}}
</p>
@endif