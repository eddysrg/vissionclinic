@extends('home.index')

@section('content')
<div>
    <div class="grid grid-cols-1">
        <div class="w-full md:h-[25rem] bg-red-500 col-start-1 col-end-2 row-start-1 row-end-2">
            <img class="h-full w-full object-cover object-[center_top]" src="{{asset('images/product-hero-main.jpeg')}}"
                alt="Banner Inicio Imagen">
        </div>

        <div class="col-start-1 col-end-2 row-start-1 row-end-2 bg-[#c0c0c0] opacity-50"></div>
    </div>
</div>
@endsection