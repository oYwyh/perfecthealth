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
        <div class="box">
            <div class="title"><?php echo app('translator')->get('titles.overview'); ?></div>
        </div>
        <?php
            if(null !== Session::get('counts')) {
                $percentageChanges = Session::get('percentageChanges');
                $counts = Session::get('counts');
            }
            if(null !== Session::get('month')) {
                $month = Session::get('month');
            }
            if(null !== Session::get('doctors')) {
                $doctors = Session::get('doctors');
            }
            if(null !== Session::get('doctors_date')) {
                $doctors_date = Session::get('doctors_date');
            }
            if(null !== Session::get('receptionists')) {
                $receptionists = Session::get('receptionists');
            }
            if(null !== Session::get('receptionists_date')) {
                $receptionists_date = Session::get('receptionists_date');
            }
        ?>
        <div class="overview admin">
            <div class="main-group">
                <div class="total">
                    <div class="header">
                        <div class="group">
                            <div class="title"><?php echo app('translator')->get('titles.total'); ?></div>
                        </div>
                        <div class="group">
                            <?php if (isset($component)) { $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form::resolve(['submitOnChange' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.total_date')),'method' => 'POST']); ?>
                                <?php if(Session::get('month')): ?>
                                <?php if (isset($component)) { $__componentOriginal10476663a3271f48a2be05c903a73050 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Select::resolve(['options' => $months,'name' => 'month','placeholder' => ''.e($month).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Select::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'select']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal10476663a3271f48a2be05c903a73050)): ?>
<?php $component = $__componentOriginal10476663a3271f48a2be05c903a73050; ?>
<?php unset($__componentOriginal10476663a3271f48a2be05c903a73050); ?>
<?php endif; ?>
                                <?php else: ?>
                                <?php if (isset($component)) { $__componentOriginal10476663a3271f48a2be05c903a73050 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Select::resolve(['options' => $months,'name' => 'month'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Select::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'select','placeholdre' => 'Date']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal10476663a3271f48a2be05c903a73050)): ?>
<?php $component = $__componentOriginal10476663a3271f48a2be05c903a73050; ?>
<?php unset($__componentOriginal10476663a3271f48a2be05c903a73050); ?>
<?php endif; ?>
                                <?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a)): ?>
<?php $component = $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a; ?>
<?php unset($__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a); ?>
<?php endif; ?>
                            <Link class="link" method="POST" href="<?php echo e(route('admin.total_reset')); ?>"><?php echo app('translator')->get('titles.reset'); ?></Link>
                        </div>
                    </div>
                    <div class="wrapper">
                        <?php $__currentLoopData = $counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="box swiper-slide">
                                <div class="group">
                                    <div class="icon">
                                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="100.000000pt" height="100.000000pt" viewBox="0 0 100.000000 100.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,100.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M121 886 c-69 -35 -71 -41 -71 -203 0 -153 9 -194 53 -241 25 -27 88 -62 112 -62 12 0 15 -14 15 -75 0 -88 15 -131 59 -168 70 -59 162 -56 226 8 46 47 55 86 55 256 l0 147 29 31 c24 26 37 31 73 31 83 -1 108 -41 108 -178 l0 -100 -37 -7 c-101 -19 -134 -144 -57 -216 36 -34 145 -39 192 -9 41 25 66 81 57 126 -6 35 -57 94 -81 94 -11 0 -14 22 -14 115 0 128 -8 155 -60 198 -66 56 -162 53 -221 -6 -45 -44 -49 -64 -49 -215 0 -75 -5 -154 -10 -174 -14 -50 -52 -78 -105 -78 -37 0 -48 5 -74 35 -29 33 -31 41 -31 109 l0 73 38 11 c21 6 52 26 71 44 59 58 65 79 69 241 l4 147 -34 33 c-40 39 -112 66 -136 50 -21 -13 -28 -59 -11 -79 13 -16 60 -19 76 -3 7 7 15 5 27 -6 25 -25 23 -234 -4 -292 -48 -106 -198 -112 -260 -11 -17 29 -20 51 -20 164 0 105 3 134 15 144 12 10 18 10 29 1 8 -7 27 -11 43 -9 25 3 28 8 31 42 5 61 -29 71 -107 32z m604 -633 c-16 -38 -17 -54 -6 -83 13 -40 -7 -37 -27 3 -10 22 -10 32 2 62 8 19 20 35 27 35 7 0 8 -7 4 -17z m123 0 c31 -28 35 -56 11 -86 -25 -32 -61 -35 -89 -7 -28 28 -25 64 6 89 32 26 46 26 72 4z"/> </g> </svg>
                                    </div>
                                    <div class="column">
                                        <div class="title">
                                            <?php if(Session::get('locale') == 'en'): ?>
                                                <?php echo e($key); ?>

                                            <?php else: ?>
                                                <?php echo e(\google_translate($key)); ?>

                                            <?php endif; ?>
                                        </div>
                                        <div class="number"><?php echo e($count); ?></div>
                                    </div>
                                </div>
                                <div class="group">
                                    <div class="date">
                                        <?php echo app('translator')->get('messages.compLastMonth'); ?>
                                    </div>
                                    <div class="analysis">
                                        <?php if(substr($percentageChanges[$key], 0, 1) == '-'): ?>
                                        <svg class="decrease" version="1.0" xmlns="http://www.w3.org/2000/svg"  width="40.000000pt" height="31.000000pt" viewBox="0 0 40.000000 31.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,31.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M56 226 c8 -14 35 -41 59 -61 l44 -35 30 32 30 33 51 -50 c27 -27 53 -46 56 -42 10 10 -90 107 -109 107 -9 0 -25 -13 -36 -29 l-21 -30 -52 50 c-55 53 -78 64 -52 25z"/> <path d="M351 167 c-1 -75 -13 -87 -88 -88 -80 -1 -40 -17 45 -18 l62 -1 -1 58 c-1 83 -17 125 -18 49z"/> </g> </svg>                                         <span class="precent decrease">
                                                <?php echo e($percentageChanges[$key]); ?>%
                                            </span>
                                                <?php else: ?>
                                            <svg clas version="1.0" xmlns="http://www.w3.org/2000/svg"  width="300.000000pt" height="193.000000pt" viewBox="0 0 300.000000 193.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,193.000000) scale(0.050000,-0.050000)" fill="#000000" stroke="none"> <path d="M3508 3021 c-381 -14 -434 -30 -458 -142 -24 -109 -34 -108 856 -121 453 -6 826 -13 829 -15 26 -17 -12 -68 -90 -124 -187 -134 -514 -429 -978 -881 -463 -451 -473 -459 -513 -424 -22 20 -146 162 -275 316 -530 634 -505 635 -1203 -17 -739 -689 -1109 -1226 -790 -1146 186 47 927 717 1282 1159 193 240 175 243 411 -67 447 -588 554 -667 738 -543 245 164 1105 1061 1516 1582 29 36 40 -125 57 -849 14 -580 27 -834 43 -850 42 -42 173 3 205 71 44 92 71 919 50 1540 l-18 520 -660 2 c-363 1 -814 -4 -1002 -11z"/> </g> </svg>
                                            <span class="precent">
                                                <?php echo e($percentageChanges[$key]); ?>%
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="group">
                    <div class="doctors">
                        <div class="header">
                            <div class="group">
                                <?php if(isset($doctors_date)): ?>
                                    <div class="title">
                                        <?php if($doctors_date == $carbon->now()->format('Y-m-d')): ?>
                                            <?php echo app('translator')->get('onDuty'); ?>
                                        <?php else: ?>
                                            <?php echo e($carbon->parse($doctors_date)->format('l')); ?> <?php echo app('translator')->get('titles.doctors'); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="title"><?php echo app('translator')->get('titles.onDuty'); ?> <?php echo app('translator')->get('titles.doctors'); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="group">
                                <?php if (isset($component)) { $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form::resolve(['submitOnChange' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'form','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.doctors_date')),'method' => 'POST']); ?>
                                    <?php if(isset($doctors_date)): ?>
                                    <?php if (isset($component)) { $__componentOriginal690b64017277cbdd89bc2d788db21f28 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Input::resolve(['name' => 'date','date' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Input::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => ''.e($doctors_date).' ('.e($doctors_date == $carbon->now()->format('Y-m-d') ? 'Today' : $carbon->parse($doctors_date)->format('l')).')']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690b64017277cbdd89bc2d788db21f28)): ?>
<?php $component = $__componentOriginal690b64017277cbdd89bc2d788db21f28; ?>
<?php unset($__componentOriginal690b64017277cbdd89bc2d788db21f28); ?>
<?php endif; ?>
                                    <?php else: ?>
                                    <?php if (isset($component)) { $__componentOriginal690b64017277cbdd89bc2d788db21f28 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Input::resolve(['name' => 'date','date' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Input::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Date']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690b64017277cbdd89bc2d788db21f28)): ?>
<?php $component = $__componentOriginal690b64017277cbdd89bc2d788db21f28; ?>
<?php unset($__componentOriginal690b64017277cbdd89bc2d788db21f28); ?>
<?php endif; ?>
                                    <?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a)): ?>
<?php $component = $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a; ?>
<?php unset($__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a); ?>
<?php endif; ?>
                                <Link class="link" method="POST" href="<?php echo e(route('admin.doctors_reset')); ?>"><?php echo app('translator')->get('titles.reset'); ?></Link>
                            </div>
                        </div>
                        <div class="header mobile none">
                            <div class="group">
                                <?php if(isset($doctors_date)): ?>
                                    <div class="title">
                                        <?php if($doctors_date == $carbon->now()->format('Y-m-d')): ?>
                                            <?php echo app('translator')->get('onDuty'); ?>
                                        <?php else: ?>
                                            <?php echo e($carbon->parse($doctors_date)->format('l')); ?> <?php echo app('translator')->get('titles.doctors'); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="title"><?php echo app('translator')->get('titles.onDuty'); ?> <?php echo app('translator')->get('titles.doctors'); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="group">
                                <form class="form" action="<?php echo e(route('admin.doctors_date')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php if(isset($doctors_date)): ?>
                                    <input  type="date" name="date" placeholder="<?php echo e($doctors_date); ?> (<?php echo e($doctors_date == $carbon->now()->format('Y-m-d') ? 'Today' : $carbon->parse($doctors_date)->format('l')); ?>)" >
                                    <?php else: ?>
                                    <input  type="date" name="date" placeholder="Date" >
                                    <?php endif; ?>
                                </form>
                                <Link class="link" method="POST" href="<?php echo e(route('admin.doctors_reset')); ?>"><?php echo app('translator')->get('titles.reset'); ?></Link>
                            </div>
                        </div>
                        <div class="wrapper">
                            <?php if(count($doctors) > 0): ?>
                                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="box">
                                        <div class="group">
                                            <div class="img-box">
                                                <img src="<?php echo e(asset('storage/' . $doctor->image)); ?>" alt="">
                                            </div>
                                            <div class="column">
                                                <div class="row">
                                                    <div class="fullname"><?php echo e($doctor->first_name); ?> <?php echo e($doctor->last_name); ?></div>
                                                    <div class="username">(&commat;<?php echo e($doctor->name); ?>)</div>
                                                </div>
                                                <div class="specialty"><?php echo e($doctor->specialty); ?></div>
                                            </div>
                                        </div>
                                        <div class="hours">
                                            <?php if(isset($doctor->today_hours)): ?>
                                                <?php $__currentLoopData = $doctor->today_hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p>
                                                        <?php $__currentLoopData = explode('-',$hour); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($carbon->parse($carbon->now()->format('Y-m-d') . ' ' . $hour . ':00:00')->format('g:i A')); ?>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </p>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <p class="note text-red-500"><?php echo app('translator')->get('messages.noData'); ?></p>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="receptionists">
                        <div class="header">
                            <div class="group">
                                <?php if(isset($receptionists_date)): ?>
                                    <div class="title">
                                        <?php echo e($receptionists_date); ?>

                                        <?php if($receptionists_date == $carbon->now()->format('Y-m-d')): ?>
                                            <?php echo app('translator')->get('titles.onDuty'); ?>
                                        <?php else: ?>
                                            <?php echo e($carbon->parse($receptionists_date)->format('l')); ?> <?php echo app('translator')->get('titles.receptionists'); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="title"><?php echo app('translator')->get('titles.onDuty'); ?> <?php echo app('translator')->get('titles.receptionists'); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="group">
                                <?php if (isset($component)) { $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form::resolve(['submitOnChange' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'form','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.receptionists_date')),'method' => 'POST']); ?>
                                    <?php if(isset($receptionists_date)): ?>
                                    
                                    <?php else: ?>
                                    <?php if (isset($component)) { $__componentOriginal690b64017277cbdd89bc2d788db21f28 = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Form\Input::resolve(['name' => 'date','date' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Form\Input::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Date']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690b64017277cbdd89bc2d788db21f28)): ?>
<?php $component = $__componentOriginal690b64017277cbdd89bc2d788db21f28; ?>
<?php unset($__componentOriginal690b64017277cbdd89bc2d788db21f28); ?>
<?php endif; ?>
                                    <?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a)): ?>
<?php $component = $__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a; ?>
<?php unset($__componentOriginal8070f1a8f8bb4059ff6ff5b9ed074a0a); ?>
<?php endif; ?>
                                <Link class="link" method="POST" href="<?php echo e(route('admin.receptionists_reset')); ?>"><?php echo app('translator')->get('titles.reset'); ?></Link>
                            </div>
                        </div>
                        <div class="header mobile none">
                            <div class="group">
                                <?php if(isset($receptionists_date)): ?>
                                    <div class="title">
                                        <?php echo e($receptionists_date); ?>

                                        <?php if($receptionists_date == $carbon->now()->format('Y-m-d')): ?>
                                            <?php echo app('translator')->get('titles.onDuty'); ?>
                                        <?php else: ?>
                                            <?php echo e($carbon->parse($receptionists_date)->format('l')); ?> <?php echo app('translator')->get('titles.receptionists'); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="title"><?php echo app('translator')->get('titles.onDuty'); ?> <?php echo app('translator')->get('titles.receptionists'); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="group">
                                <form class="form" action="<?php echo e(route('admin.receptionists_date')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php if(isset($receptionists_date)): ?>
                                    <input  type="date" name="date" placeholder="<?php echo e($receptionists_date); ?> (<?php echo e($receptionists_date == $carbon->now()->format('Y-m-d') ? 'Today' : $carbon->parse($receptionists_date)->format('l')); ?>)" >
                                    <?php else: ?>
                                    <input  type="date" name="date" placeholder="Date" >
                                    <?php endif; ?>
                                </form>
                                <Link class="link" method="POST" href="<?php echo e(route('admin.receptionists_reset')); ?>"><?php echo app('translator')->get('titles.reset'); ?></Link>
                            </div>
                        </div>
                        <div class="wrapper">
                            <?php if(count($receptionists) > 0): ?>
                                <?php $__currentLoopData = $receptionists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receptionist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="box">
                                        <div class="group">
                                            <div class="img-box">
                                                <img src="<?php echo e(asset('storage/' . $receptionist->image)); ?>" alt="">
                                            </div>
                                            <div class="column">
                                                <div class="row">
                                                    <div class="fullname"><?php echo e($receptionist->first_name); ?> <?php echo e($receptionist->last_name); ?></div>
                                                    <div class="username">(&commat;<?php echo e($receptionist->name); ?>)</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hours">
                                            <?php if(isset($receptionist->today_hours)): ?>
                                                <?php $__currentLoopData = $receptionist->today_hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p>
                                                        <?php $__currentLoopData = explode('-',$hour); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($carbon->parse($carbon->now()->format('Y-m-d') . ' ' . $hour . ':00:00')->format('g:i A')); ?>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </p>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <p class="note text-red-500"><?php echo app('translator')->get('messages.noData'); ?></p>
                            <?php endif; ?>

                        </div>
                    </div>
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
<?php $component->withAttributes([]); ?>

            const doctorsHeader = document.querySelector('.doctors .header')
            const doctorsMobileHeader = document.querySelector('.doctors .header.mobile')
            if (window.matchMedia('(max-width: 768px)').matches) {
                doctorsHeader.classList.add('none')
                doctorsMobileHeader.classList.remove('none')
                doctorsMobileHeader.querySelector('input[type="date"]').onchange = () => {
                    doctorsMobileHeader.querySelector('form').submit()
                }
            }
            const receptionistsHeader = document.querySelector('.receptionists .header')
            const receptionistsMobileHeader = document.querySelector('.receptionists .header.mobile')
            if (window.matchMedia('(max-width: 768px)').matches) {
                receptionistsHeader.classList.add('none')
                receptionistsMobileHeader.classList.remove('none')
                receptionistsMobileHeader.querySelector('input[type="date"]').onchange = () => {
                    receptionistsMobileHeader.querySelector('form').submit()
                }
            }
            
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b)): ?>
<?php $component = $__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b; ?>
<?php unset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b); ?>
<?php endif; ?>
        
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

<?php /**PATH /home/ywyh/coding/github/perfecthealth/resources/views/dashboard/admin/home.blade.php ENDPATH**/ ?>