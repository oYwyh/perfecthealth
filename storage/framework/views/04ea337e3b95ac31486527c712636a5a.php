<SpladeFile
    :form="form"
    :field="<?php echo \Illuminate\Support\Js::from($formKey())->toHtml() ?>"
    :multiple="<?php echo \Illuminate\Support\Js::from($multiple)->toHtml() ?>"
    :placeholder="<?php echo \Illuminate\Support\Js::from($placeholder)->toHtml() ?>"
    :filepond="<?php echo \Illuminate\Support\Js::from($filepondOptions())->toHtml() ?>"
    :js-filepond-options="<?php echo $jsFilepondOptions(); ?>"
    :server="<?php echo \Illuminate\Support\Js::from($server)->toHtml() ?>"
    :preview="<?php echo \Illuminate\Support\Js::from($preview)->toHtml() ?>"
    :accept="<?php echo \Illuminate\Support\Js::from($accept)->toHtml() ?>"
    :existing-suffix="<?php echo \Illuminate\Support\Js::from($existingSuffix)->toHtml() ?>"
    :order-suffix="<?php echo \Illuminate\Support\Js::from($orderSuffix)->toHtml() ?>"
    :min-file-size="<?php echo \Illuminate\Support\Js::from($minSize)->toHtml() ?>"
    :max-file-size="<?php echo \Illuminate\Support\Js::from($maxSize)->toHtml() ?>"
    :min-image-width="<?php echo \Illuminate\Support\Js::from($minWidth)->toHtml() ?>"
    :max-image-width="<?php echo \Illuminate\Support\Js::from($maxWidth)->toHtml() ?>"
    :min-image-height="<?php echo \Illuminate\Support\Js::from($minHeight)->toHtml() ?>"
    :max-image-height="<?php echo \Illuminate\Support\Js::from($maxHeight)->toHtml() ?>"
    :min-image-resolution="<?php echo \Illuminate\Support\Js::from($minResolution)->toHtml() ?>"
    :max-image-resolution="<?php echo \Illuminate\Support\Js::from($maxResolution)->toHtml() ?>"
    v-on:start-uploading="form.$startUploading"
    v-on:stop-uploading="form.$stopUploading"
    :dusk="<?php echo \Illuminate\Support\Js::from($attributes->get('dusk'))->toHtml() ?>"
    <?php echo e($attributes->only(['v-if', 'v-show', 'class'])); ?>

>
    <template #default="<?php echo $scope; ?>">
        <label class="block">
            <?php echo $__env->renderWhen($label, 'splade::form.label', ['label' => $label], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

            <?php if($filepond): ?>
                <input <?php echo e($attributes->except(['v-if', 'v-show', 'class'])->merge([
                    'name' => $name,
                    'multiple' => $multiple,
                    'type' => 'file',
                    'data-validation-key' => $validationKey(),
                ])); ?>

                />
            <?php else: ?>
                <a @submit.prevent
                    class="inline-block py-2 px-3 rounded-md border border-gray-300 shadow-sm bg-white hover:bg-gray-100 relative cursor-pointer font-medium text-gray-700 text-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:border-indigo-300 focus:ring-indigo-200 text-center">

                    <?php if(trim($slot)): ?>
                        <?php echo e($slot); ?>

                    <?php else: ?>
                        <?php echo e($placeholder); ?>

                    <?php endif; ?>

                    <input @change="file.handleFileInput" <?php echo e($attributes->except(['v-if', 'v-show', 'class'])->class([
                        'invisible absolute inset-0 w-full h-full disabled:opacity-50'
                    ])->merge([
                        'name' => $name,
                        'multiple' => $multiple,
                        'type' => 'file',
                        'data-validation-key' => $validationKey(),
                    ])); ?>

                        <?php if(count($accept) > 0): ?>
                            accept="<?php echo e(implode(',', $accept)); ?>"
                        <?php endif; ?>
                    />
                </a>
            <?php endif; ?>

            <?php echo $__env->renderWhen($help, 'splade::form.help', ['help' => $help], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        </label>

        <?php if(!$filepond && $showFilename): ?>
            <div class="mt-2 text-sm italic" v-if="file.filenames.length > 0">
                <p v-for="(filename, key) in file.filenames" v-bind:key="key" v-text="filename" />
            </div>
        <?php endif; ?>

        <?php echo $__env->renderWhen($showErrors, 'splade::form.error', ['name' => $validationKey()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    </template>
</SpladeFile><?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/form/file.blade.php ENDPATH**/ ?>