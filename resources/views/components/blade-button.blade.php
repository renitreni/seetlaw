<button {{
    $attributes->merge([
        'class'=> "border gap-2 text-green-950 flex justify-between items-center py-1.5 px-2  duration-200 hover:text-white  text-sm rounded-md border-teal-900",
        'type'=>"button"
    ])
}}>
    {{ $slot }}
</button>
