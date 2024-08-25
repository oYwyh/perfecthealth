<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.content','data' => ['class' => 'bg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin.content'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'bg']); ?>
        <div class="title"><?php echo app('translator')->get('titles.manage'); ?> <?php echo app('translator')->get('titles.services'); ?></div>
        <Link class="add" href="<?php echo e(route('admin.manage.services.add')); ?>"><?php echo app('translator')->get('buttons.add'); ?> <?php echo app('translator')->get('titles.service'); ?></Link>
        <div class="wrapper" style="">
            <?php if (isset($component)) { $__componentOriginal9e290f7144d9abd075e5cf038a814133 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Table::resolve(['for' => $services] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Table::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <?php $__env->slot('spladeTableCell418c5509e2171d55b0aee5c2ea4442b5', function ($service) use ($__env) { ?>
                    <Link href="<?php echo e(route('admin.manage.services.edit',['id'=>$service->id,'oldImage' => $service->image])); ?>" class="text-green-500"> <?php echo app('translator')->get('buttons.edit'); ?> </Link>
                    <Link href="<?php echo e(route('admin.manage.services.delete',['id'=>$service->id])); ?>" method="POST" class="text-red-500 ms-2">  <?php echo app('translator')->get('buttons.delete'); ?> </Link>
                <?php }); ?>
                <?php $__env->slot('spladeTableCelledb72a68a9cfaab392fe8cf95baeb80d', function ($service) use ($__env) { ?>
                    <?php if($service->frontpage == 0): ?>
                        <Link href="<?php echo e(route('admin.manage.services.verify',['id'=>$service->id])); ?>"  method="POST" class="capitalize text-red-500 ms-2"><?php echo app('translator')->get('buttons.false'); ?></Link>
                    <?php else: ?>
                        <Link href="<?php echo e(route('admin.manage.services.disprove',['id'=>$service->id])); ?>"   method="POST" class="capitalize text-green-500 ms-2"><?php echo app('translator')->get('buttons.true'); ?></Link>
                    <?php endif; ?>
                <?php }); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9e290f7144d9abd075e5cf038a814133)): ?>
<?php $component = $__componentOriginal9e290f7144d9abd075e5cf038a814133; ?>
<?php unset($__componentOriginal9e290f7144d9abd075e5cf038a814133); ?>
<?php endif; ?>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH /home/ywyh/coding/github/perfecthealth/resources/views/dashboard/admin/manage/services/index.blade.php ENDPATH**/ ?>