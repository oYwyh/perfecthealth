<div class="footer">
    <div class="newsletter">
        <?php if (isset($component)) { $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form::resolve(['background' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'form','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('newsletter.subscribe'))]); ?>
            <?php if(Session::get('locale') == 'en'): ?>
                <?php if (isset($component)) { $__componentOriginal690b64017277cbdd89bc2d788db21f28 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Input::resolve(['name' => 'email'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Input::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'input','placeholder' => 'Subscribe to newsletter']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690b64017277cbdd89bc2d788db21f28)): ?>
<?php $component = $__componentOriginal690b64017277cbdd89bc2d788db21f28; ?>
<?php unset($__componentOriginal690b64017277cbdd89bc2d788db21f28); ?>
<?php endif; ?>
                <?php else: ?>
                <?php if (isset($component)) { $__componentOriginal690b64017277cbdd89bc2d788db21f28 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Input::resolve(['name' => 'email'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Input::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'input','placeholder' => 'اشترك في النشرة الاخبارية']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690b64017277cbdd89bc2d788db21f28)): ?>
<?php $component = $__componentOriginal690b64017277cbdd89bc2d788db21f28; ?>
<?php unset($__componentOriginal690b64017277cbdd89bc2d788db21f28); ?>
<?php endif; ?>
            <?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal2d975ce603f483bebe2dbee59a477e99 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Submit::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Submit::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'submit']); ?>
                <?php echo app('translator')->get('buttons.subscribe'); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2d975ce603f483bebe2dbee59a477e99)): ?>
<?php $component = $__componentOriginal2d975ce603f483bebe2dbee59a477e99; ?>
<?php unset($__componentOriginal2d975ce603f483bebe2dbee59a477e99); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a)): ?>
<?php $component = $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a; ?>
<?php unset($__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a); ?>
<?php endif; ?>
    </div>
    <div class="wrapper">
        <div class="info">
            <div class="box main">
                
                <Link class="logo" href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(asset('images/logo/full/gold_horizontal.png')); ?>" alt="">
                </Link>
                <div class="desc"><?php echo app('translator')->get('footer.description'); ?></div>
                <Link class="btn primary-btn" href="<?php echo e(route('user.manage.appointments.search')); ?>"><?php echo app('translator')->get('buttons.book'); ?></Link>

            </div>
            <div class="row">
                <div class="box quick-links">
                    <div class="title"><?php echo app('translator')->get('footer.quickTitle'); ?></div>
                    <ul>
                        <li><Link href="#"><?php echo app('translator')->get('footer.home'); ?></Link></li>
                        <li><Link href="#"><?php echo app('translator')->get('footer.articles'); ?></Link></li>
                        <li><Link href="#"><?php echo app('translator')->get('footer.info'); ?></Link></li>
                        <?php if(auth()->guard('admin')->check()): ?>
                            <li><Link class="link" href="<?php echo e(route('admin.home')); ?>"><?php echo app('translator')->get('footer.dashboard'); ?> </Link><span></span></li>
                        <?php endif; ?>
                        <?php if(auth()->guard('web')->check()): ?>
                            <li><Link class="link" href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('footer.dashboard'); ?> </Link><span></span></li>
                        <?php endif; ?>
                        <?php if(auth()->guard('doctor')->check()): ?>
                            <li><Link class="link" href="<?php echo e(route('doctor.home')); ?>"><?php echo app('translator')->get('footer.dashboard'); ?> </Link><span></span></li>
                        <?php endif; ?>
                        <?php if(auth()->guard('receptionist')->check()): ?>
                            <li><Link class="link" href="<?php echo e(route('receptionist.home')); ?>"><?php echo app('translator')->get('footer.dashboard'); ?> </Link><span></span></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="box work-time">
                    <div class="title"><?php echo app('translator')->get('footer.workTitle'); ?></div>
                    <div class="column">
                        <div class="small-box">
                            <div class="title"><?php echo app('translator')->get('footer.locationOne'); ?></div>
                            <div class="days"><?php echo app('translator')->get('footer.locationOneDays'); ?></div>
                            <div class="hours"><?php echo app('translator')->get('footer.locationOneHours'); ?></div>
                        </div>
                        <div class="small-box">
                            <div class="title last"><?php echo app('translator')->get('footer.locationTwo'); ?></div>
                            <div class="days"><?php echo app('translator')->get('footer.locationOneDays'); ?></div>
                            <div class="hours"><?php echo app('translator')->get('footer.locationOneHours'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="box dashboard">
                    <div class="title"><?php echo app('translator')->get('footer.dashboardTitle'); ?></div>
                    <ul>
                        <?php if(auth()->guard('admin')->check()): ?>
                            <li><Link href="<?php echo e(route('admin.profile.index')); ?>"><?php echo app('translator')->get('footer.profile'); ?></Link></li>
                            <li><Link href="<?php echo e(route('admin.home')); ?>"><?php echo app('translator')->get('footer.overview'); ?></Link></li>
                        <?php endif; ?>
                        <?php if(auth()->guard('web')->check()): ?>
                            <li><Link href="<?php echo e(route('user.profile.index')); ?>"><?php echo app('translator')->get('footer.profile'); ?></Link></li>
                            <li><Link href="<?php echo e(route('user.manage.appointments.search')); ?>"><?php echo app('translator')->get('footer.book'); ?></Link></li>
                            <li><Link href="<?php echo e(route('user.file')); ?>"><?php echo app('translator')->get('footer.medical'); ?></Link></li>
                        <?php endif; ?>
                        <?php if(auth()->guard('doctor')->check()): ?>
                            <li><Link href="<?php echo e(route('doctor.profile.index')); ?>"><?php echo app('translator')->get('footer.profile'); ?></Link></li>
                            <li><Link href="<?php echo e(route('doctor.home')); ?>"><?php echo app('translator')->get('footer.overview'); ?></Link></li>
                            <li><Link href="<?php echo e(route('doctor.manage.appointments.index')); ?>"><?php echo app('translator')->get('footer.latest'); ?></Link></li>
                        <?php endif; ?>
                        <?php if(auth()->guard('receptionist')->check()): ?>
                            <li><Link href="<?php echo e(route('receptionist.profile.index')); ?>"><?php echo app('translator')->get('footer.profile'); ?></Link></li>
                            <li><Link href="<?php echo e(route('receptionist.home')); ?>"><?php echo app('translator')->get('footer.overview'); ?></Link></li>
                        <?php endif; ?>
                        <?php if(!Auth::user()): ?>
                            <li><Link href="<?php echo e(route('user.profile.index')); ?>"><?php echo app('translator')->get('footer.profile'); ?></Link></li>
                            <li><Link href="<?php echo e(route('user.manage.appointments.search')); ?>"><?php echo app('translator')->get('footer.book'); ?></Link></li>
                            <li><Link href="<?php echo e(route('user.file')); ?>"><?php echo app('translator')->get('footer.medical'); ?></Link></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="box social-footer">
                    <div class="title"><?php echo app('translator')->get('footer.socialTitle'); ?></div>
                    <ul>
                        <li><Link href="https://www.facebook.com/profile.php?id=100083383471982"><?php echo app('translator')->get('social.facebook'); ?></Link></li>
                        <li><Link href="https://m.me/waleed.haikal.3"><?php echo app('translator')->get('social.messenger'); ?></Link></li>
                        <li><Link href="https://wa.me/201024824716"><?php echo app('translator')->get('social.whatsapp'); ?></Link></li>
                        <li><Link href="tel:201024824716"><?php echo app('translator')->get('social.phone'); ?></Link></li>
                        <li><Link href="mailto:waldmed@waleedhaikal.com"><?php echo app('translator')->get('social.mail'); ?></Link></li>
                        <li><Link href="https://waleedhaikal.com"><?php echo app('translator')->get('social.website'); ?></Link></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="copyright">
            <div class="rights"><?php echo app('translator')->get('messages.copyright'); ?> &copy; <span id="year"></span> 1.1</div>
            <a href="mailto:support@waleedhaikal.com" class="under"><?php echo app('translator')->get('messages.under'); ?></a>
            <div class="creator"><?php echo app('translator')->get('messages.madeby'); ?> <a href="mailto:ywyhinfo@gmail.com"><?php echo app('translator')->get('messages.creator'); ?></a></div>
        </div>
    </div>
</div>
<?php if (isset($component)) { $__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Script::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-script'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Script::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>let date = new Date(); document.getElementById('year').innerHTML = date.getFullYear() <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b)): ?>
<?php $component = $__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b; ?>
<?php unset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b); ?>
<?php endif; ?>
<?php /**PATH /home/ywyh/coding/github/perfecthealth/resources/views/components/frontend/footer.blade.php ENDPATH**/ ?>