<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['baseAttributes','key','closeButton','closeExplicitly','name'])
<x-splade-modal-wrapper :base-attributes="$baseAttributes" :key="$key" :close-button="$closeButton" :close-explicitly="$closeExplicitly" :name="$name" {{ $attributes }}>

{{ $slot ?? "" }}
</x-splade-modal-wrapper>