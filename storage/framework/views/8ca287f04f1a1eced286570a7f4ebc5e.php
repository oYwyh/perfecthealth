<thead class="bg-gray-50">
    <tr>
        <?php if($hasBulkActions = $table->hasBulkActions()): ?>
            <th width="64" class="px-6 py-3 text-xs">
                <?php echo $__env->make('splade::table.select-rows-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </th>
        <?php endif; ?>

        <?php $__currentLoopData = $table->columns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th
                v-show="table.columnIsVisible(<?php echo \Illuminate\Support\Js::from($column->key)->toHtml() ?>)"
                class="<?php if($loop->first && $hasBulkActions): ?> pr-6 <?php else: ?> px-6 <?php endif; ?> py-3 text-left text-xs font-medium tracking-wide text-gray-500 <?php echo e($column->classes); ?>"
            >
                <?php if($column->sortable): ?>
                    <a @click.exact.prevent="table.navigate(<?php echo \Illuminate\Support\Js::from($sortByUrl = $sortBy($column))->toHtml() ?>)" dusk="sort-<?php echo e($column->key); ?>" href="<?php echo e($sortByUrl); ?>">
                <?php endif; ?>

                <span class="flex flex-row items-center <?php if($column->alignment == 'right'): ?> justify-end <?php elseif($column->alignment == 'center'): ?> justify-center <?php else: ?> justify-start <?php endif; ?>">
                    <span class="uppercase"><?php echo e($column->label); ?></span>

                    <?php if($column->sortable): ?>
                        <svg aria-hidden="true" class="w-3 h-3 ml-2 <?php if($column->sorted): ?> text-green-500 <?php else: ?> text-gray-400 <?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <?php if(!$column->sorted): ?>
                                <path fill="currentColor" d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z" />
                            <?php elseif($column->sorted === 'asc'): ?>
                                <path fill="currentColor" d="M279 224H41c-21.4 0-32.1-25.9-17-41L143 64c9.4-9.4 24.6-9.4 33.9 0l119 119c15.2 15.1 4.5 41-16.9 41z" />
                            <?php elseif($column->sorted === 'desc'): ?>
                                <path fill="currentColor" d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z" />
                            <?php endif; ?>
                        </svg>
                    <?php endif; ?>
                </span>

                <?php if($column->sortable): ?>
                    </a>
                <?php endif; ?>
            </th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
</thead><?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/table/head.blade.php ENDPATH**/ ?>