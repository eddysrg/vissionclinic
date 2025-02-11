@extends('record.record')

@section('content')

<x-notification/>

<h2 class="text-3xl text-[#174075]">Referencia</h2>

@livewire('reference', ['patient' => $patient])

@endsection