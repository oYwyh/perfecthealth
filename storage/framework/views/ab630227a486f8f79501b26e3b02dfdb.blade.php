<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>

<x-splade-button-with-dropdown  {{ $attributes }}>
<x-slot name="button" >{{ $button }}</x-slot>
{{ $slot ?? "" }}
</x-splade-button-with-dropdown>