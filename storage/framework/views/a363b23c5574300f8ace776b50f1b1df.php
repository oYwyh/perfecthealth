<SpladeJoditEditor
    <?php echo e($attributes->only(['v-if', 'v-show', 'class'])); ?>

    :options="<?php echo \Illuminate\Support\Js::from($joditOptions())->toHtml() ?>"
    :js-options="<?php echo $jsJoditOptions(); ?>"
    v-model="<?php echo e($vueModel()); ?>"
    :dusk="<?php echo \Illuminate\Support\Js::from($attributes->get('dusk'))->toHtml() ?>"
>
    <label class="block">
        <?php echo $__env->renderWhen($label, 'splade::form.label', ['label' => $label], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

        <textarea <?php echo e($attributes->except(['v-if', 'v-show', 'class'])->class(
            'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50'
        )->merge([
            'name' => $name,
            'v-model' => $vueModel(),
            'data-validation-key' => $validationKey(),
        ])); ?>></textarea>
    </label>

    <?php echo $__env->renderWhen($help, 'splade::form.help', ['help' => $help], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php echo $__env->renderWhen($showErrors, 'splade::form.error', ['name' => $validationKey()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</SpladeJoditEditor>
<?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/form/wysiwyg.blade.php ENDPATH**/ ?>