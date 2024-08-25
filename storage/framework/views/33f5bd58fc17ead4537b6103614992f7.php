<?php if (isset($component)) { $__componentOriginal584f017b33a17ce6e81d05c022b925ba = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\SpladeComponent::resolve(['is' => 'button-with-dropdown'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\SpladeComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dusk' => 'columns-dropdown']); ?>
     <?php $__env->slot('button', null, []); ?> 
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
            :class="{
                'text-gray-400': !table.columnsAreToggled,
                'text-green-400': table.columnsAreToggled,
            }">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
        </svg>
     <?php $__env->endSlot(); ?>

    <div class="px-2">
        <ul class="divide-y divide-gray-200">
            <?php $__currentLoopData = $table->columns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$column->canBeHidden): ?>
                    <?php continue; ?>
                <?php endif; ?>

                <li class="py-2 flex items-center justify-between">
                    <p class="text-sm text-gray-900">
                        <?php echo e($column->label); ?>

                    </p>

                    <button
                        type="button"
                        class="ml-4 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-light-blue-500"
                        :class="{
                            'bg-green-500': table.columnIsVisible(<?php echo \Illuminate\Support\Js::from($column->key)->toHtml() ?>),
                            'bg-gray-200': !table.columnIsVisible(<?php echo \Illuminate\Support\Js::from($column->key)->toHtml() ?>),
                        }"
                        :aria-pressed="table.columnIsVisible(<?php echo \Illuminate\Support\Js::from($column->key)->toHtml() ?>)"
                        aria-labelledby="toggle-column-<?php echo e($column->key); ?>"
                        aria-describedby="toggle-column-<?php echo e($column->key); ?>"
                        @click.prevent="table.toggleColumn(<?php echo \Illuminate\Support\Js::from($column->key)->toHtml() ?>)"
                        dusk="toggle-column-<?php echo e($column->key); ?>"
                    >
                        <span class="sr-only">Column status</span>
                        <span
                            aria-hidden="true"
                            :class="{
                                'translate-x-5': table.columnIsVisible(<?php echo \Illuminate\Support\Js::from($column->key)->toHtml() ?>),
                                'translate-x-0': !table.columnIsVisible(<?php echo \Illuminate\Support\Js::from($column->key)->toHtml() ?>),
                            }"
                            class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-300" />
                    </button>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal584f017b33a17ce6e81d05c022b925ba)): ?>
<?php $component = $__componentOriginal584f017b33a17ce6e81d05c022b925ba; ?>
<?php unset($__componentOriginal584f017b33a17ce6e81d05c022b925ba); ?>
<?php endif; ?><?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/table/columns.blade.php ENDPATH**/ ?>