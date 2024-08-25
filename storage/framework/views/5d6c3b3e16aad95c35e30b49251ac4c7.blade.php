<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['closeOnClick'])
<x-splade-dropdown :close-on-click="$closeOnClick" {{ $attributes }}>
<x-slot name="trigger" >{{ $trigger }}</x-slot>
{{ $slot ?? "" }}
</x-splade-dropdown>