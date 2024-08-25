<SpladeTable <?php echo e($attributes->except('class')); ?>

    :striped="<?php echo \Illuminate\Support\Js::from($striped)->toHtml() ?>"
    :columns="<?php echo \Illuminate\Support\Js::from($table->columns())->toHtml() ?>"
    :search-debounce="<?php echo \Illuminate\Support\Js::from($searchDebounce)->toHtml() ?>"
    :default-visible-toggleable-columns="<?php echo \Illuminate\Support\Js::from($table->defaultVisibleToggleableColumns())->toHtml() ?>"
    :items-on-this-page="<?php echo \Illuminate\Support\Js::from($table->totalOnThisPage())->toHtml() ?>"
    :items-on-all-pages="<?php echo \Illuminate\Support\Js::from($table->totalOnAllPages())->toHtml() ?>"
    :base-url="<?php echo \Illuminate\Support\Js::from(request()->url())->toHtml() ?>"
    :pagination-scroll="<?php echo \Illuminate\Support\Js::from($paginationScroll)->toHtml() ?>"
    :splade-id="<?php echo \Illuminate\Support\Js::from($spladeId = $table->getSpladeId())->toHtml() ?>"
>
    <template #default="<?php echo $scope; ?>">
        <div <?php echo e($attributes->only('class')); ?> :class="{ 'opacity-50': table.isLoading }" data-splade-id="<?php echo e($spladeId); ?>">
            <?php if($hasControls()): ?>
                <?php echo $__env->make('splade::table.controls', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php $__currentLoopData = $table->searchInputs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $searchInput): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->renderUnless($searchInput->key === 'global', 'splade::table.search-row', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if (isset($component)) { $__componentOriginal584f017b33a17ce6e81d05c022b925ba = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\SpladeComponent::resolve(['is' => 'table-wrapper'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\SpladeComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <table class="min-w-full divide-y divide-gray-200 bg-white">
                    <?php if (! ($headless)): ?>
                        <?php if(isset($head)): ?>
                            <?php echo e($head); ?>

                        <?php elseif(count($table->resource)): ?>
                            <?php echo $__env->make('splade::table.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(isset($body)): ?>
                        <?php echo e($body); ?>

                    <?php else: ?>
                        <?php echo $__env->make('splade::table.body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </table>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal584f017b33a17ce6e81d05c022b925ba)): ?>
<?php $component = $__componentOriginal584f017b33a17ce6e81d05c022b925ba; ?>
<?php unset($__componentOriginal584f017b33a17ce6e81d05c022b925ba); ?>
<?php endif; ?>

            <?php if($showPaginator()): ?>
                <?php echo e($table->resource->links($paginationView, ['table' => $table, 'hasPerPageOptions' => $hasPerPageOptions()])); ?>

            <?php endif; ?>
        </div>
    </template>
</SpladeTable><?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/table/table.blade.php ENDPATH**/ ?>