@extends('record.record')

@section('content')
<h2 class="text-3xl text-[#174075]">Ficha de identificación</h2>

<x-notification />

<div class="mt-8">
    @livewire('identification-form', ['patient' => $patient])
</div>


@endsection