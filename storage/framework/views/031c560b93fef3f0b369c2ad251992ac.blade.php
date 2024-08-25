<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>

<x-splade-table-wrapper  {{ $attributes }}>

{{ $slot ?? "" }}
</x-splade-table-wrapper>