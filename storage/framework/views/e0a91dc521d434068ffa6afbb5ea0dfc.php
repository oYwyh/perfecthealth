<SpladeDialog #default="{ Dialog, DialogPanel, isActivated: isActivated<?php echo e($spladeId); ?> }">
    <component
        <?php echo e($attributes
            ->mergeVueBinding(':is', $panel ? 'DialogPanel' : 'Dialog')
            ->mergeVueBinding(':open', $open ? ('(' . e($open) . ') && isActivated' . $spladeId) : '', escape: false)
            ->mergeVueBinding(':unmount', $unmount)
            ->mergeVueBinding('@close', $close)); ?>

    >
        <?php echo e($slot); ?>

    </component>
</SpladeDialog><?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/functional/dialog.blade.php ENDPATH**/ ?>