@extends('record.record')

@section('content')

<x-notification/>

<h2 class="text-3xl text-[#174075]">Laboratorio</h2>

@livewire('laboratory', ['patient' => $patient])

@endsection