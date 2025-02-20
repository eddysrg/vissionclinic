<button {{$attributes->merge(['type'=> 'submit', 'class' => 'bg-white w-full rounded md:rounded-full py-2 font-semibold'])}}>
    {{$slot}}
</button>