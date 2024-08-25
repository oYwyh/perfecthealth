<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>

<x-splade-dropdown  {{ $attributes }}>
<x-slot name="trigger" >{{ $trigger }}</x-slot>
{{ $slot ?? "" }}
</x-splade-dropdown>