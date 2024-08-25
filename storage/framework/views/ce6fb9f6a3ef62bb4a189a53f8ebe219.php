<div <?php echo e($attributes->only(['v-if', 'v-show', 'class'])); ?>>
    <label class="flex items-center">
        <input <?php echo e($attributes->except(['v-if', 'v-show', 'class'])->class(
            'rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50'
        )->merge([
            'name' => $name,
            'value' => $value,
            'type' => 'checkbox',
            'v-model' => $vueModel(),
            'data-validation-key' => $validationKey(),
        ])); ?> :true-value="<?php echo \Illuminate\Support\Js::from($value)->toHtml() ?>" :false-value="<?php echo \Illuminate\Support\Js::from($falseValue)->toHtml() ?>" />

        <?php if(trim($slot)): ?>
            <span class="ml-2"><?php echo e($slot); ?></span>
        <?php else: ?>
            <span class="ml-2"><?php echo e($label); ?></span>
        <?php endif; ?>
    </label>

    <?php echo $__env->renderWhen($help, 'splade::form.help', ['help' => $help], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php echo $__env->renderWhen($showErrors, 'splade::form.error', ['name' => $validationKey()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</div>


<?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/form/checkbox.blade.php ENDPATH**/ ?>