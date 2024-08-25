<?php
    [$gridClasses, $otherClasses] = collect(explode(' ', $attributes->get('class')))
        ->partition(fn ($class) => Str::startsWith($class, ['gap', 'grid']) || Str::contains($class, [':gap', ':grid']));
?>

<div <?php echo e($attributes->only(['v-if', 'v-show'])->class($otherClasses->all())->merge([
    'data-validation-key' => $validationKey(),
])); ?>>
    <?php echo $__env->renderWhen($label, 'splade::form.label', ['label' => $label], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <div <?php echo e($attributes->except(['v-if', 'v-show', 'class'])->class([
        'flex flex-wrap space-x-6' => $inline && $gridClasses->isEmpty(),
        'space-y-1' => !$inline && $gridClasses->isEmpty(),
    ])->class($gridClasses->all())); ?>

    >
      <?php echo e($slot); ?>

    </div>

    <?php echo $__env->renderWhen($help, 'splade::form.help', ['help' => $help], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php echo $__env->renderWhen($showErrors, 'splade::form.error', ['name' => $validationKey()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</div><?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/form/group.blade.php ENDPATH**/ ?>