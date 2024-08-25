<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="info main">
        <div class="wrapper">
            <div class="about">
                <div class="title">
                    <?php echo app('translator')->get('info.aboutTitle'); ?>
                </div>
                <div class="description">
                    <?php echo app('translator')->get('info.aboutDescription'); ?>
                </div>
            </div>
            <div class="content">
                <div class="mission">
                    <div class="title">
                        <?php echo app('translator')->get('info.missionTitle'); ?>
                    </div>
                    <div class="description">
                        <?php echo app('translator')->get('info.missionDescription'); ?>
                    </div>
                </div>
                <div class="vision">
                    <div class="title">
                        <?php echo app('translator')->get('info.visionTitle'); ?>
                    </div>
                    <div class="description">
                        <?php echo app('translator')->get('info.visionDescription'); ?>
                    </div>
                </div>
                <div class="culture">
                    <div class="title">
                        <?php echo app('translator')->get('info.cultureTitle'); ?>
                    </div>
                    <div class="description">
                        <?php echo app('translator')->get('info.cultureDescription'); ?>
                    </div>
                </div>
                <div class="objectives">
                    <div class="title">
                        <?php echo app('translator')->get('info.objectivesTitle'); ?>
                    </div>
                    <div class="description">
                        <?php echo app('translator')->get('info.objectivesDescription'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH /home/ywyh/coding/github/perfecthealth/resources/views/frontend/info.blade.php ENDPATH**/ ?>