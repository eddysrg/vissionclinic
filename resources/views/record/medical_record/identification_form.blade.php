@extends('record.record')

@section('content')
<h2 class="text-3xl text-[#174075]">Ficha de identificación</h2>

<x-notification />

<div class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center" id="loading">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>

<div class="mt-8">
    @livewire('identification-form', ['patient' => $patient])
</div>


@endsection