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
        <div class="title"><?php echo app('translator')->get('titles.manage'); ?> <?php echo app('translator')->get('titles.receptionists'); ?></div>
        <Link class="add" href="<?php echo e(route('admin.manage.receptionists.add')); ?>"><?php echo app('translator')->get('buttons.add'); ?> <?php echo app('translator')->get('titles.receptionist'); ?></Link>
        <div class="wrapper" style="">
            <?php if (isset($component)) { $__componentOriginal9e290f7144d9abd075e5cf038a814133 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Table::resolve(['for' => $receptionists] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Table::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                
                <?php $__env->slot('spladeTableCell5b05a36937a9cc09fbd7f9a451bd1711', function ($receptionist) use ($__env) { ?>
                <p><?php echo e(str_replace('|',',',$receptionist->days)); ?></p>
                <?php }); ?>
                <?php $__env->slot('spladeTableCell6e052d6c20de1264f66690f413098bb0', function ($receptionist) use ($__env) { ?>
                    <?php
                        $days = explode('|', $receptionist->hours);
                        $formattedDays = [];

                        foreach ($days as $day) {
                            $dayParts = explode('_', $day);
                            $dayName = substr($dayParts[0], 0, 3);
                            $hours = explode(',', $dayParts[1]);

                            $formattedHours = [];
                            foreach ($hours as $hour) {
                                $hourParts = explode('-', $hour);
                                $startHour = date("ga", strtotime($hourParts[0] . ":00"));
                                $endHour = date("ga", strtotime($hourParts[1] . ":00"));
                                $formattedHours[] = $startHour . ' to ' . $endHour;
                            }

                            $formattedDays[] = $dayName . ' => ' . implode(' , ', $formattedHours);
                        }

                        echo '<p style="text-transform: capitalize;">'. implode(' | ', $formattedDays) .'</p>'
                    ?>
                <?php }); ?>
                <?php $__env->slot('spladeTableCellf28185d762af16471070289c69f72331', function ($receptionist) use ($__env) { ?>
                    <Link href="<?php echo e(route('admin.manage.receptionists.control',['id'=>$receptionist->id])); ?>" class="text-blue-500">Full Control</Link>
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
<?php /**PATH /home/ywyh/coding/github/perfecthealth/resources/views/dashboard/admin/manage/receptionists/index.blade.php ENDPATH**/ ?>