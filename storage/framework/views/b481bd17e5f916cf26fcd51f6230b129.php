<tbody class="divide-y divide-gray-200 bg-white">
    <?php $__empty_1 = true; $__currentLoopData = $table->resource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemKey => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr
            :class="{
                'bg-gray-50': table.striped && <?php echo \Illuminate\Support\Js::from($itemKey)->toHtml() ?> % 2,
                'hover:bg-gray-100': table.striped,
                'hover:bg-gray-50': !table.striped
            }"
        >
            <?php if($hasBulkActions = $table->hasBulkActions()): ?>
                <td width="64" class="text-xs px-6 py-4">
                    <?php $itemPrimaryKey = $table->findPrimaryKey($item) ?>

                    <input
                        @change="(e) => table.setSelectedItem(<?php echo \Illuminate\Support\Js::from($itemPrimaryKey)->toHtml() ?>, e.target.checked)"
                        :checked="table.itemIsSelected(<?php echo \Illuminate\Support\Js::from($itemPrimaryKey)->toHtml() ?>)"
                        :disabled="table.allItemsFromAllPagesAreSelected"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50"
                        name="table-row-bulk-action"
                        type="checkbox"
                        value="<?php echo e($itemPrimaryKey); ?>"
                    />
                </td>
            <?php endif; ?>

            <?php $__currentLoopData = $table->columns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td
                    <?php if($table->rowLinks->has($itemKey)): ?>
                        @click="(event) => table.visit(<?php echo \Illuminate\Support\Js::from($table->rowLinks->get($itemKey))->toHtml() ?>, <?php echo \Illuminate\Support\Js::from($table->rowLinkType)->toHtml() ?>, event)"
                    <?php endif; ?>
                    v-show="table.columnIsVisible(<?php echo \Illuminate\Support\Js::from($column->key)->toHtml() ?>)"
                    class="whitespace-nowrap text-sm <?php if($loop->first && $hasBulkActions): ?> pr-6 <?php else: ?> px-6 <?php endif; ?> py-4 <?php if($column->highlight): ?> text-gray-900 font-medium <?php else: ?> text-gray-500 <?php endif; ?> <?php if($table->rowLinks->has($itemKey)): ?> cursor-pointer <?php endif; ?> <?php echo e($column->classes); ?>"
                >
                    <div class="flex flex-row items-center <?php if($column->alignment == 'right'): ?> justify-end <?php elseif($column->alignment == 'center'): ?> justify-center <?php else: ?> justify-start <?php endif; ?>">
                        <?php if(isset(${'spladeTableCell' . $column->keyHash()})): ?>
                            <?php echo e(${'spladeTableCell' . $column->keyHash()}($item, $itemKey)); ?>

                        <?php else: ?>
                            <?php echo nl2br(e($getColumnDataFromItem($item, $column))); ?>

                        <?php endif; ?>
                    </div>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="<?php echo e($table->columns()->count()); ?>" class="whitespace-nowrap">
                <?php if(isset($emptyState) && !!$emptyState): ?>
                    <?php echo e($emptyState); ?>

                <?php else: ?>
                    <p class="text-gray-700 px-6 py-12 font-medium text-sm text-center">
                        <?php echo e(__('There are no items to show.')); ?>

                    </p>
                <?php endif; ?>
            </td>
        </tr>
    <?php endif; ?>
</tbody>
<?php /**PATH /home/ywyh/coding/github/perfecthealth/vendor/protonemedia/laravel-splade/src/../resources/views/table/body.blade.php ENDPATH**/ ?>