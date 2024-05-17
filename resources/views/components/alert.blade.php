@props(['type', 'message'])

@php
    $alertClasses = [
        'success' => 'bg-green-100 border-green-400 text-green-600',
        'error' => 'bg-red-100 border-red-400 text-red-600',
        'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-600',
        'info' => 'bg-blue-100 border-blue-400 text-blue-600',
    ];
@endphp
<div class="{{ $alertClasses[$type] }} border px-4 py-3 rounded relative" role="alert">
    <h4 class="font-bold capitalize">{{ $type }}!</h4>
    <p>{{ $message }}</p>
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close">
        <span class="{{ $alertClasses[$type] }}" aria-hidden="true">&times;</span>
    </button>
</div>
