@props([
    'first',
    'second',
    'third',
    'firstLink',
    'secondLink',
])

<div class="pl-0 mt-1 text-sm breadcrumbs">
	<ul>
		<li>
			<a href="{{ isset($firstLink) ? $firstLink : "#" }}">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-2 stroke-current">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
				</svg>
				<p>{{ isset($first) ? $first : "" }}</p>
			</a>
		</li>

        @if(isset($secondLink))
		<li>
			<a href="{{$secondLink}}">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-2 stroke-current">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
				</svg>
				<p>{{ isset($second) ? $second : "" }}</p>
			</a>
		</li>
        @else
        <li>{{ isset($second) ? $second : "" }}</li>
        @endif
        @if (isset($third))
		    <li>{{ isset($third) ? $third : "" }}</li>
        @endif
	</ul>
</div>
