<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['child','animation','afterLeave','animate'])
<x-splade-transition :child="$child" :animation="$animation" :after-leave="$afterLeave" :animate="$animate" {{ $attributes }}>

{{ $slot ?? "" }}
</x-splade-transition>