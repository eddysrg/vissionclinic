@extends('record.record')

@section('content')

<x-notification/>

<h2 class="text-3xl text-[#174075]">Consulta Médica</h2>

@livewire('medical-consultation', ['patient' => $patient])

@endsection