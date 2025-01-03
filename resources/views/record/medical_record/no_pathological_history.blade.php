@extends('record.record')

@section('content')

<x-notification/>

<h2 class="text-3xl text-[#174075]">Antecedentes No Patológicos</h2>

@livewire('no-pathological-history', ['patient' => $patient])

@endsection