<?php $attributes = $selectChild->attributes() ?>

<?php if($selectChild->isGroup()): ?>
    <optgroup <?php echo e($attributes); ?>>
        <?php $__currentLoopData = $selectChild->getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nestedSelectChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('splade::form.select-child', ['selectChild' => $nestedSelectChild], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </optgroup>
<?php else: ?>
    <option <?php echo e($attributes->except('label')); ?> <?php if($selected($attributes->get('value'))): ?> selected <?php endif; ?>>
        <?php echo e($attributes->get('label')); ?>

    </option>
<?php endif; ?><?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/form/select-child.blade.php ENDPATH**/ ?>