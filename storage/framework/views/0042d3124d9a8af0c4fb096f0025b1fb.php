<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['baseAttributes','key','closeButton','closeExplicitly','name']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['baseAttributes','key','closeButton','closeExplicitly','name']); ?>
<?php foreach (array_filter((['baseAttributes','key','closeButton','closeExplicitly','name']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php if (isset($component)) { $__componentOriginal16143908f3a5c804770e3fa993948664 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\ModalWrapper::resolve(['baseAttributes' => $baseAttributes,'key' => $key,'closeButton' => $closeButton,'closeExplicitly' => $closeExplicitly,'name' => $name] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-modal-wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\ModalWrapper::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16143908f3a5c804770e3fa993948664)): ?>
<?php $component = $__componentOriginal16143908f3a5c804770e3fa993948664; ?>
<?php unset($__componentOriginal16143908f3a5c804770e3fa993948664); ?>
<?php endif; ?><?php /**PATH /home/ywyh/coding/github/perfecthealth/storage/framework/views/7bd860c0046fbc4d86c78ded4f34340f.blade.php ENDPATH**/ ?>