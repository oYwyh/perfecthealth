<?php
    $user = null;
    $guards = ['web', 'admin', 'doctor', 'receptionist'];
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            break;
        }
    }
?>
<style>
    .link img {
        width: 100%;
    }
</style>
<div class="front-header">
    <div class="wrapper">
        <div class="start">
            <Link class="logo" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('images/logo/perfect-horizontal.png')); ?>" alt="">
            </Link>
        </div>
        <div class="center">
            <ul class="links">
                <li><Link class="link" href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('header.home'); ?></Link> <span></span></li>
                
                
                <li><Link class="link" href="<?php echo e(route('articles.index')); ?>"><?php echo app('translator')->get('header.articles'); ?> </Link><span></span></li>
                <li><Link class="link" href="<?php echo e(route('info.index')); ?>"><?php echo app('translator')->get('header.info'); ?> </Link><span></span></li>
                <?php if(auth()->guard('admin')->check()): ?>
                    <li><Link class="link" href="<?php echo e(route('admin.home')); ?>"><?php echo app('translator')->get('header.dashboard'); ?> </Link><span></span></li>
                <?php endif; ?>
                <?php if(auth()->guard('web')->check()): ?>
                    <li><Link class="link" href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('header.dashboard'); ?> </Link><span></span></li>
                <?php endif; ?>
                <?php if(auth()->guard('doctor')->check()): ?>
                    <li><Link class="link" href="<?php echo e(route('doctor.home')); ?>"><?php echo app('translator')->get('header.dashboard'); ?> </Link><span></span></li>
                <?php endif; ?>
                <?php if(auth()->guard('receptionist')->check()): ?>
                    <li><Link class="link" href="<?php echo e(route('receptionist.home')); ?>"><?php echo app('translator')->get('header.dashboard'); ?> </Link><span></span></li>
                <?php endif; ?>

                

                <ul class="locale">
                    <?php if (isset($component)) { $__componentOriginalf128d9c762a54c6319e56d0f2cbd6d1e = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Toggle::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Toggle::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <div class="selected" @click.prevent="toggle">
                            <?php if(Session::get('locale') == 'en'): ?>
                                اللغة <i class="fa-solid fa-chevron-down"></i>
                                <?php else: ?>
                                Language <i class="fa-solid fa-chevron-down"></i>
                            <?php endif; ?>
                        </div>
                        <?php if (isset($component)) { $__componentOriginal9c1b3bcdbb92880d08ba057cf26c9bd2 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Transition::resolve(['show' => 'toggled'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-transition'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Transition::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <div class="lang">
                                <li><Link class="link" href="<?php echo e(url('locale/en')); ?>">
                                    <img src="<?php echo e(asset('svg/uk.png')); ?>" alt="">
                                    English
                                </Link></li>
                                <li>
                                <Link class="link" href="<?php echo e(url('locale/ar')); ?>">
                                    <img src="<?php echo e(asset('svg/eg.png')); ?>" alt="">
                                    العربية
                                </Link></li>
                            </div>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c1b3bcdbb92880d08ba057cf26c9bd2)): ?>
<?php $component = $__componentOriginal9c1b3bcdbb92880d08ba057cf26c9bd2; ?>
<?php unset($__componentOriginal9c1b3bcdbb92880d08ba057cf26c9bd2); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf128d9c762a54c6319e56d0f2cbd6d1e)): ?>
<?php $component = $__componentOriginalf128d9c762a54c6319e56d0f2cbd6d1e; ?>
<?php unset($__componentOriginalf128d9c762a54c6319e56d0f2cbd6d1e); ?>
<?php endif; ?>
                </ul>
            </ul>
        </div>
        <div class="end">
            <?php if($user): ?>
                <div class="profile">
                    <?php if (isset($component)) { $__componentOriginalf128d9c762a54c6319e56d0f2cbd6d1e = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Toggle::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Toggle::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <div class="profile-pic" @click.prevent="toggle" id="droppbtn">
                                <?php if($user->image): ?>
                                    <?php if(Str::startsWith($user->image, ['http://', 'https://'])): ?>
                                        <img src="<?php echo e($user->image); ?>" alt="">
                                    <?php else: ?>
                                        <?php if(Storage::exists('public/'. $user->image)): ?>
                                            <img src="<?php echo e(asset('storage/'.$user->image)); ?>" alt="">
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('storage/'.'images/profiles/default.jpg')); ?>" alt="">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('storage/'.'images/profiles/default.jpg')); ?>" alt="">
                                <?php endif; ?>
                            </div>
                        <?php if (isset($component)) { $__componentOriginal9c1b3bcdbb92880d08ba057cf26c9bd2 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Transition::resolve(['show' => 'toggled'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-transition'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Transition::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php if($user): ?>
                                <div class="profile-content">
                                    <?php if(auth()->guard('admin')->check()): ?>
                                        <?php if (isset($component)) { $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'form','method' => 'GET','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Route('admin.profile.index'))]); ?>
                                            <?php if (isset($component)) { $__componentOriginal2d975ce603f483bebe2dbee59a477e99 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Submit::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Submit::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => 'background: none; color:black !important; border:none !important;']); ?><?php echo e($user->name); ?> <?php echo $__env->renderComponent(); ?>
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
                                    <?php endif; ?>
                                    <?php if(auth()->guard('web')->check()): ?>
                                        <?php if (isset($component)) { $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'form','method' => 'GET','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Route('user.profile.index'))]); ?>
                                            <?php if (isset($component)) { $__componentOriginal2d975ce603f483bebe2dbee59a477e99 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Submit::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Submit::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => 'background: none; color:black !important; border:none !important;']); ?><?php echo e($user->name); ?> <?php echo $__env->renderComponent(); ?>
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
                                    <?php endif; ?>
                                    <?php if(auth()->guard('doctor')->check()): ?>
                                        <?php if (isset($component)) { $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'form','method' => 'GET','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Route('doctor.profile.index'))]); ?>
                                            <?php if (isset($component)) { $__componentOriginal2d975ce603f483bebe2dbee59a477e99 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Submit::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Submit::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => 'background: none; color:black !important; border:none !important;']); ?><?php echo e($user->name); ?> <?php echo $__env->renderComponent(); ?>
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
                                    <?php endif; ?>
                                    <?php if(auth()->guard('receptionist')->check()): ?>
                                        <?php if (isset($component)) { $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'form','method' => 'GET','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Route('receptionist.profile.index'))]); ?>
                                            <?php if (isset($component)) { $__componentOriginal2d975ce603f483bebe2dbee59a477e99 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Submit::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Submit::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => 'background: none; color:black !important; border:none !important;']); ?><?php echo e($user->name); ?> <?php echo $__env->renderComponent(); ?>
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
                                    <?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'form','confirm' => true,'action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Route('logout'))]); ?>
                                        <?php if (isset($component)) { $__componentOriginal2d975ce603f483bebe2dbee59a477e99 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Submit::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Submit::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => 'background: none; color:black !important; border:none !important;']); ?><?php echo app('translator')->get('auth.logout'); ?> <?php echo $__env->renderComponent(); ?>
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
                            <?php endif; ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c1b3bcdbb92880d08ba057cf26c9bd2)): ?>
<?php $component = $__componentOriginal9c1b3bcdbb92880d08ba057cf26c9bd2; ?>
<?php unset($__componentOriginal9c1b3bcdbb92880d08ba057cf26c9bd2); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf128d9c762a54c6319e56d0f2cbd6d1e)): ?>
<?php $component = $__componentOriginalf128d9c762a54c6319e56d0f2cbd6d1e; ?>
<?php unset($__componentOriginalf128d9c762a54c6319e56d0f2cbd6d1e); ?>
<?php endif; ?>
                </div>
                <?php else: ?>
                <Link class="auth-link" method="POST" modal href="<?php echo e(route('login')); ?>">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>
                        <?php echo app('translator')->get('auth.login'); ?>
                    </span>
                </Link>
                <?php endif; ?>
                <div class="side-wrapper">
                    <div id="mySidenav" class="sidenav">
                        <div class="header">
                            <img src="<?php echo e(asset('images/logo/perfect-horizontal.png')); ?>" alt="">
                            <div id="close">
                                <svg data-v-575a134c="" data-v-6075a6c8="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-label="close" role="presentation" class="h-nav__mobile-menu-burger h-icon-dark" style="width: 24px; height: 24px;"><g data-v-575a134c=""><path data-v-575a134c="" fill-rule="evenodd" clip-rule="evenodd" d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z"></path></g></svg>                        </div>
                            </div>
                        <div class="wrapper">
                            <ul class="start">
                                <li>
                                    <Link class="link" href="<?php echo e(route('home')); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 32 32">
                                            <path d="M 16 2.59375 L 15.28125 3.28125 L 2.28125 16.28125 L 3.71875 17.71875 L 5 16.4375 L 5 28 L 14 28 L 14 18 L 18 18 L 18 28 L 27 28 L 27 16.4375 L 28.28125 17.71875 L 29.71875 16.28125 L 16.71875 3.28125 Z M 16 5.4375 L 25 14.4375 L 25 26 L 20 26 L 20 16 L 12 16 L 12 26 L 7 26 L 7 14.4375 Z"></path>
                                        </svg>
                                        <?php echo app('translator')->get('header.home'); ?>
                                    </Link>
                                    <span></span>
                                </li>
                                <li>
                                    <Link class="link" href="<?php echo e(route('articles.index')); ?>">
                                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="300.000000pt" height="300.000000pt" viewBox="0 0 300.000000 300.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M680 2840 c-89 -14 -180 -87 -219 -175 -21 -47 -21 -55 -21 -921 l0 -873 26 -20 c34 -27 47 -26 81 3 l28 24 5 864 c4 628 8 868 17 883 18 32 55 61 92 74 24 8 213 11 636 11 541 0 603 -2 609 -16 3 -9 6 -62 6 -119 0 -124 18 -175 89 -244 74 -75 131 -91 314 -91 189 1 197 5 197 102 0 130 -64 264 -177 370 -52 48 -102 77 -188 112 -48 19 -76 20 -750 22 -385 1 -720 -1 -745 -6z m1492 -168 c92 -48 147 -102 194 -196 36 -71 30 -90 -26 -94 -25 -2 -74 -1 -109 3 -56 6 -69 12 -105 45 l-41 38 -3 111 -4 111 29 0 c16 0 45 -8 65 -18z"/> <path d="M2430 2030 c-11 -11 -22 -30 -25 -42 -3 -13 -4 -268 -3 -566 l3 -544 28 -24 c34 -29 47 -30 81 -3 l26 20 0 574 0 573 -25 16 c-33 21 -61 20 -85 -4z"/> <path d="M1161 1794 c-28 -35 -26 -65 4 -94 23 -22 33 -23 114 -21 49 1 100 -1 114 -5 l26 -6 3 -340 3 -340 24 -19 c29 -24 53 -24 82 0 l24 19 3 341 3 340 32 5 c18 3 69 4 114 4 74 -1 85 1 108 22 32 30 32 64 0 95 l-24 25 -305 0 -305 0 -20 -26z"/> <path d="M804 595 c-23 -35 -12 -88 22 -103 18 -9 204 -12 670 -12 l645 0 24 25 c29 28 32 61 9 93 l-15 22 -669 0 -670 0 -16 -25z"/> <path d="M823 260 c-25 -10 -38 -56 -24 -92 6 -17 20 -27 41 -32 41 -8 787 -8 827 0 18 4 36 17 47 35 16 27 16 31 0 58 -10 16 -27 32 -38 35 -34 9 -829 5 -853 -4z"/> <path d="M1993 261 c-12 -6 -24 -23 -28 -41 -9 -43 15 -77 61 -86 44 -8 134 2 148 16 15 15 13 87 -2 102 -15 15 -148 22 -179 9z"/> </g> </svg>
                                        <?php echo app('translator')->get('header.articles'); ?>
                                    </Link>
                                    <span></span>
                                </li>
                                <?php if(auth()->guard('admin')->check()): ?>
                                    <li>
                                        <Link class="link" href="<?php echo e(route('admin.home')); ?>">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="300.000000pt" height="300.000000pt" viewBox="0 0 300.000000 300.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M373 2489 c-55 -25 -98 -69 -123 -126 -19 -44 -20 -65 -20 -757 0 -628 2 -714 16 -734 8 -12 12 -27 9 -32 -3 -6 -41 -10 -84 -10 -69 0 -80 -3 -101 -25 -19 -20 -22 -32 -18 -67 12 -97 81 -192 173 -238 l50 -25 1215 0 1215 0 50 25 c92 46 161 141 173 238 4 35 1 47 -18 67 -21 22 -32 25 -101 25 -43 0 -81 4 -84 10 -3 5 1 20 9 32 14 20 16 106 16 735 0 649 -2 716 -17 750 -24 54 -81 111 -132 134 -42 18 -75 19 -1115 18 -1035 -1 -1072 -1 -1113 -20z m2197 -115 c63 -38 60 -3 60 -764 0 -761 3 -726 -60 -764 -26 -15 -124 -16 -1080 -16 -956 0 -1054 1 -1080 16 -63 38 -60 3 -60 764 0 758 -3 725 59 763 24 15 123 16 1079 17 958 0 1056 -1 1082 -16z m205 -1674 c8 -13 -30 -60 -73 -88 l-33 -22 -1179 0 -1179 0 -33 22 c-43 28 -81 75 -73 88 9 14 2561 14 2570 0z"/> <path d="M1315 2198 c-3 -7 -4 -276 -3 -598 l3 -585 175 0 175 0 0 595 0 595 -173 3 c-132 2 -174 0 -177 -10z m230 -588 l0 -475 -55 0 -55 0 -3 465 c-1 256 0 471 3 478 3 9 21 12 57 10 l53 -3 0 -475z"/> <path d="M1795 1958 c-3 -7 -4 -222 -3 -478 l3 -465 175 0 175 0 0 475 0 475 -173 3 c-132 2 -174 0 -177 -10z m230 -468 l0 -355 -55 0 -55 0 -3 345 c-1 190 0 351 3 358 3 9 21 12 57 10 l53 -3 0 -355z"/> <path d="M835 1658 c-3 -7 -4 -155 -3 -328 l3 -315 175 0 175 0 0 325 0 325 -173 3 c-133 2 -174 0 -177 -10z m230 -318 l0 -205 -55 0 -55 0 -3 195 c-1 107 0 200 3 208 3 9 21 12 57 10 l53 -3 0 -205z"/> </g> </svg>
                                            <?php echo app('translator')->get('header.dashboard'); ?>
                                        </Link>
                                        <span></span>
                                    </li>
                                <?php endif; ?>
                                <?php if(auth()->guard('web')->check()): ?>
                                    <li>
                                        <Link class="link" href="<?php echo e(route('user.home')); ?>">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="300.000000pt" height="300.000000pt" viewBox="0 0 300.000000 300.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M373 2489 c-55 -25 -98 -69 -123 -126 -19 -44 -20 -65 -20 -757 0 -628 2 -714 16 -734 8 -12 12 -27 9 -32 -3 -6 -41 -10 -84 -10 -69 0 -80 -3 -101 -25 -19 -20 -22 -32 -18 -67 12 -97 81 -192 173 -238 l50 -25 1215 0 1215 0 50 25 c92 46 161 141 173 238 4 35 1 47 -18 67 -21 22 -32 25 -101 25 -43 0 -81 4 -84 10 -3 5 1 20 9 32 14 20 16 106 16 735 0 649 -2 716 -17 750 -24 54 -81 111 -132 134 -42 18 -75 19 -1115 18 -1035 -1 -1072 -1 -1113 -20z m2197 -115 c63 -38 60 -3 60 -764 0 -761 3 -726 -60 -764 -26 -15 -124 -16 -1080 -16 -956 0 -1054 1 -1080 16 -63 38 -60 3 -60 764 0 758 -3 725 59 763 24 15 123 16 1079 17 958 0 1056 -1 1082 -16z m205 -1674 c8 -13 -30 -60 -73 -88 l-33 -22 -1179 0 -1179 0 -33 22 c-43 28 -81 75 -73 88 9 14 2561 14 2570 0z"/> <path d="M1315 2198 c-3 -7 -4 -276 -3 -598 l3 -585 175 0 175 0 0 595 0 595 -173 3 c-132 2 -174 0 -177 -10z m230 -588 l0 -475 -55 0 -55 0 -3 465 c-1 256 0 471 3 478 3 9 21 12 57 10 l53 -3 0 -475z"/> <path d="M1795 1958 c-3 -7 -4 -222 -3 -478 l3 -465 175 0 175 0 0 475 0 475 -173 3 c-132 2 -174 0 -177 -10z m230 -468 l0 -355 -55 0 -55 0 -3 345 c-1 190 0 351 3 358 3 9 21 12 57 10 l53 -3 0 -355z"/> <path d="M835 1658 c-3 -7 -4 -155 -3 -328 l3 -315 175 0 175 0 0 325 0 325 -173 3 c-133 2 -174 0 -177 -10z m230 -318 l0 -205 -55 0 -55 0 -3 195 c-1 107 0 200 3 208 3 9 21 12 57 10 l53 -3 0 -205z"/> </g> </svg>
                                            <?php echo app('translator')->get('header.dashboard'); ?>
                                        </Link>
                                        <span></span>
                                    </li>
                                <?php endif; ?>
                                <?php if(auth()->guard('doctor')->check()): ?>
                                    <li>
                                        <Link class="link" href="<?php echo e(route('doctor.home')); ?>">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="300.000000pt" height="300.000000pt" viewBox="0 0 300.000000 300.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M373 2489 c-55 -25 -98 -69 -123 -126 -19 -44 -20 -65 -20 -757 0 -628 2 -714 16 -734 8 -12 12 -27 9 -32 -3 -6 -41 -10 -84 -10 -69 0 -80 -3 -101 -25 -19 -20 -22 -32 -18 -67 12 -97 81 -192 173 -238 l50 -25 1215 0 1215 0 50 25 c92 46 161 141 173 238 4 35 1 47 -18 67 -21 22 -32 25 -101 25 -43 0 -81 4 -84 10 -3 5 1 20 9 32 14 20 16 106 16 735 0 649 -2 716 -17 750 -24 54 -81 111 -132 134 -42 18 -75 19 -1115 18 -1035 -1 -1072 -1 -1113 -20z m2197 -115 c63 -38 60 -3 60 -764 0 -761 3 -726 -60 -764 -26 -15 -124 -16 -1080 -16 -956 0 -1054 1 -1080 16 -63 38 -60 3 -60 764 0 758 -3 725 59 763 24 15 123 16 1079 17 958 0 1056 -1 1082 -16z m205 -1674 c8 -13 -30 -60 -73 -88 l-33 -22 -1179 0 -1179 0 -33 22 c-43 28 -81 75 -73 88 9 14 2561 14 2570 0z"/> <path d="M1315 2198 c-3 -7 -4 -276 -3 -598 l3 -585 175 0 175 0 0 595 0 595 -173 3 c-132 2 -174 0 -177 -10z m230 -588 l0 -475 -55 0 -55 0 -3 465 c-1 256 0 471 3 478 3 9 21 12 57 10 l53 -3 0 -475z"/> <path d="M1795 1958 c-3 -7 -4 -222 -3 -478 l3 -465 175 0 175 0 0 475 0 475 -173 3 c-132 2 -174 0 -177 -10z m230 -468 l0 -355 -55 0 -55 0 -3 345 c-1 190 0 351 3 358 3 9 21 12 57 10 l53 -3 0 -355z"/> <path d="M835 1658 c-3 -7 -4 -155 -3 -328 l3 -315 175 0 175 0 0 325 0 325 -173 3 c-133 2 -174 0 -177 -10z m230 -318 l0 -205 -55 0 -55 0 -3 195 c-1 107 0 200 3 208 3 9 21 12 57 10 l53 -3 0 -205z"/> </g> </svg>
                                            <?php echo app('translator')->get('header.dashboard'); ?>
                                        </Link>
                                        <span></span>
                                    </li>
                                <?php endif; ?>
                                <?php if(auth()->guard('receptionist')->check()): ?>
                                    <li>
                                        <Link class="link" href="<?php echo e(route('receptionist.home')); ?>">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="300.000000pt" height="300.000000pt" viewBox="0 0 300.000000 300.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M373 2489 c-55 -25 -98 -69 -123 -126 -19 -44 -20 -65 -20 -757 0 -628 2 -714 16 -734 8 -12 12 -27 9 -32 -3 -6 -41 -10 -84 -10 -69 0 -80 -3 -101 -25 -19 -20 -22 -32 -18 -67 12 -97 81 -192 173 -238 l50 -25 1215 0 1215 0 50 25 c92 46 161 141 173 238 4 35 1 47 -18 67 -21 22 -32 25 -101 25 -43 0 -81 4 -84 10 -3 5 1 20 9 32 14 20 16 106 16 735 0 649 -2 716 -17 750 -24 54 -81 111 -132 134 -42 18 -75 19 -1115 18 -1035 -1 -1072 -1 -1113 -20z m2197 -115 c63 -38 60 -3 60 -764 0 -761 3 -726 -60 -764 -26 -15 -124 -16 -1080 -16 -956 0 -1054 1 -1080 16 -63 38 -60 3 -60 764 0 758 -3 725 59 763 24 15 123 16 1079 17 958 0 1056 -1 1082 -16z m205 -1674 c8 -13 -30 -60 -73 -88 l-33 -22 -1179 0 -1179 0 -33 22 c-43 28 -81 75 -73 88 9 14 2561 14 2570 0z"/> <path d="M1315 2198 c-3 -7 -4 -276 -3 -598 l3 -585 175 0 175 0 0 595 0 595 -173 3 c-132 2 -174 0 -177 -10z m230 -588 l0 -475 -55 0 -55 0 -3 465 c-1 256 0 471 3 478 3 9 21 12 57 10 l53 -3 0 -475z"/> <path d="M1795 1958 c-3 -7 -4 -222 -3 -478 l3 -465 175 0 175 0 0 475 0 475 -173 3 c-132 2 -174 0 -177 -10z m230 -468 l0 -355 -55 0 -55 0 -3 345 c-1 190 0 351 3 358 3 9 21 12 57 10 l53 -3 0 -355z"/> <path d="M835 1658 c-3 -7 -4 -155 -3 -328 l3 -315 175 0 175 0 0 325 0 325 -173 3 c-133 2 -174 0 -177 -10z m230 -318 l0 -205 -55 0 -55 0 -3 195 c-1 107 0 200 3 208 3 9 21 12 57 10 l53 -3 0 -205z"/> </g> </svg>
                                            <?php echo app('translator')->get('header.dashboard'); ?>
                                        </Link>
                                        <span></span>
                                    </li>
                                <?php endif; ?>
                                <?php if(Session::get('locale') == 'en'): ?>
                                    <li>
                                        <Link class="link" href="<?php echo e(url('locale/ar')); ?>">
                                            <img src="<?php echo e(asset('svg/eg.png')); ?>" width="30" alt="">
                                            العربية
                                        </Link>
                                        <span></span>
                                    </li>
                                    <?php else: ?>
                                    <li>
                                        <Link class="link" href="<?php echo e(url('locale/en')); ?>">
                                            <img src="<?php echo e(asset('svg/uk.png')); ?>" width="30" alt="">
                                            English
                                        </Link>
                                        <span></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <ul class="end">
                                <?php if($user): ?>
                                    <li>
                                        <Link class="link review" id="review" modal href="<?php echo e(route('reviews.index')); ?>">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="100.000000pt" height="100.000000pt" viewBox="0 0 100.000000 100.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,100.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M472 938 c-10 -24 -40 -97 -66 -164 l-47 -121 -67 -7 c-37 -3 -96 -6 -132 -7 -86 -1 -153 -11 -157 -25 -3 -8 203 -187 260 -225 7 -5 -58 -278 -80 -335 -3 -7 2 -17 11 -20 10 -4 66 26 151 80 74 48 141 89 149 92 7 3 77 -36 154 -87 92 -59 147 -89 158 -85 9 3 14 13 11 20 -11 29 -88 328 -85 330 41 29 268 221 268 227 0 16 -23 20 -187 30 -92 5 -169 11 -170 13 -2 2 -32 74 -66 161 -34 87 -68 160 -74 163 -8 2 -21 -15 -31 -40z m38 -48 c0 -6 23 -71 52 -145 l52 -135 45 -1 c25 -1 97 -4 159 -8 l113 -6 -120 -95 c-75 -59 -120 -102 -121 -114 0 -19 66 -272 76 -287 9 -15 1 -11 -131 76 -72 47 -135 83 -140 81 -6 -2 -64 -39 -130 -82 -129 -85 -141 -92 -132 -77 10 17 77 269 77 289 -1 12 -47 55 -120 114 l-119 95 112 6 c62 4 133 7 158 8 l45 1 52 135 c29 74 52 139 52 145 0 5 5 10 10 10 6 0 10 -5 10 -10z"/> </g> </svg>
                                            <span class="gone"><?php echo app('translator')->get('messages.leaveReview'); ?></span>
                                        </Link>
                                    </li>
                                    <li class="img">
                                        <Link class="link" href="<?php echo e(route('user.profile.index')); ?>">
                                            <div class="box">
                                                <?php if($user->image): ?>
                                                    <?php if(Str::startsWith($user->image, ['http://', 'https://'])): ?>
                                                        <img src="<?php echo e($user->image); ?>" alt="">
                                                    <?php else: ?>
                                                        <?php if(Storage::exists('public/'. $user->image)): ?>
                                                            <img src="<?php echo e(asset('storage/'.$user->image)); ?>" alt="">
                                                            <?php else: ?>
                                                            <img src="<?php echo e(asset('storage/'.'images/profiles/default.jpg')); ?>" alt="">
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('storage/'.'images/profiles/default.jpg')); ?>" alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="column">
                                                <div class="name"><?php echo e($user->name); ?></div>
                                                <div class="email"><?php echo e($user->email); ?></div>
                                            </div>
                                        </Link>
                                    </li>
                                    <li class="logout">
                                        <Link confirm class="link" method="POST" href="<?php echo e(Route('logout')); ?>">
                                            <svg
                                            class="h-5 w-5 text-red-700"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                            </svg>
                                            <span class="gone"><?php echo app('translator')->get('auth.logout'); ?></span>
                                        </Link>
                                    </li>
                                    <?php else: ?>
                                    <li class="login" >
                                        <Link modal class="link" id="login" method="GET" href="<?php echo e(Route('login')); ?>">
                                            <svg
                                            class="h-5 w-5 text-red-700"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="30"
                                            height="30"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                            </svg>
                                            <span class="gone">
                                                <?php echo app('translator')->get('auth.login'); ?>
                                            </span>
                                        </Link>
                                    </li>
                                    <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div id="hamburger">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
        </div>
    </div>
</div>
<?php if(auth()->guard('web')->check()): ?>
    <?php if(Auth::user()->verified == '0'): ?>
        <div class="verify-alert"><?php echo app('translator')->get('messages.verify'); ?><Link id="code" modal href="<?php echo e(route('code-checker')); ?>"> <?php echo app('translator')->get('buttons.click'); ?></Link></div>
    <?php endif; ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Script::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-script'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Script::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    
    if(document.getElementById('login') != null) {
        document.getElementById('login').onclick = () => {
            toggleNav()
        }
    }
    if(document.getElementById('review') != null) {
        document.getElementById('review').onclick = () => {
            toggleNav()
        }
    }
    document.querySelector('#hamburger').onclick = () => {
        toggleNav()
    }
    document.querySelector('#close').onclick = () => {
        toggleNav()
    }
    function toggleNav() {
        const nav = document.getElementById("mySidenav");
        const hamburger = document.getElementById("hamburger");
        document.getElementById('backdrop').classList.toggle('active');
        hamburger.classList.toggle('change');
        nav.classList.toggle('active');
        if(nav.classList.contains('active')) {
            
        }else {
            document.body.style.overflowY = 'scroll'
        }
    }
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b)): ?>
<?php $component = $__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b; ?>
<?php unset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b); ?>
<?php endif; ?>
<?php /**PATH /home/ywyh/coding/github/perfecthealth/resources/views/components/frontend/header.blade.php ENDPATH**/ ?>