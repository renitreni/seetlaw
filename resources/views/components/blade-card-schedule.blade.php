@props([
    "number",
    "day",
    "type"
])

<div {{ $attributes->merge([
    'class' => "px-6 py-3 space-y-1 shadow border border-green-950 rounded bg-gradient-to-r from-green-100 to-green-700/30"
    ]) }}>
    <div class="flex items-center justify-between ">
        <p><span class="font-bold">Case Number</span>: {{ $number ?? "" }}.</p>
        <div class="badge badge-xs">{{ $day ?? "" }}</div>
    </div>
    <p><span class="font-bold">Case Type</span>: {{ $type ?? "" }}</p>
</div>
