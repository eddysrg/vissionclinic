@props(['name'])

<div>
    <a href="{{route('producto', ['producto' => $name->route_name])}}"
        class="block min-w-full max-w-80 h-64 shadow-lg rounded overflow-hidden cursor-pointer hover:scale-105 duration-200">
        <img class="w-full h-full object-cover" src="{{asset('images/product-' . $name->route_name . '.jpeg')}}"
            alt="Laboratorio imagen">
    </a>

    <p class="text-2xl font-medium text-center mt-5">{{$name->title}}</p>
</div>