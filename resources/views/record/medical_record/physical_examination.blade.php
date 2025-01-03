@extends('record.record')

@section('content')

<x-notification/>

<h2 class="text-3xl text-[#174075]">Exploración Física</h2>

@livewire('physical-examination', ['patient' => $patient])

@endsection