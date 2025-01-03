@extends('record.record')

@section('content')

<x-notification/>

<h2 class="text-3xl text-[#174075]">Antecedentes Heredofamiliares</h2>

@livewire('family-medical-history', ['patient' => $patient])
@endsection