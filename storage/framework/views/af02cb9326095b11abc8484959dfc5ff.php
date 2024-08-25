
<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <style>
        .front-main {
            margin: 0 !important;
            padding: 0
        }
    </style>
    <div class="articles">
        <div class="main-title">
            <div class="group">
                <div class="title"><?php echo app('translator')->get('articlespage.title'); ?></div>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.partials.search','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('partials.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
        </div>
        <div class="wrapper">
            <div class="big-box">
                <?php if(count($articles) != '0'): ?>
                <div class="article-box">
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box">
                            <div class="overlay">
                                <Link class="btn outline-btn" href="/articles/<?php echo e($article->id); ?>">
                                    <?php echo app('translator')->get('buttons.read'); ?>
                                </Link>
                            </div>
                            <div class="img-box">
                                <?php if(Session::get('locale') == 'en'): ?>
                                        <?php if(Storage::exists('public/'. $article->image)): ?>
                                            <img src="<?php echo e(asset('storage/'.$article->image)); ?>" alt="image" class="img">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/'.'images/articles/thumbnails/default.png')); ?>" alt="">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(Storage::exists('public/'. $article->image_ar)): ?>
                                            <img src="<?php echo e(asset('storage/'.$article->image_ar)); ?>" alt="image" class="img">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/'.'images/articles/thumbnails/default.png')); ?>" alt="">
                                        <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="column">
                                <div class="title">
                                    <?php if(Session::get('locale') == 'en'): ?>
                                        <?php echo e($article->title); ?>

                                    <?php else: ?>
                                        <?php echo e($article->title_ar); ?>

                                    <?php endif; ?>
                                </div>
                                <div class="description">
                                    <?php if(Session::get('locale') == 'en'): ?>
                                        <?php echo e(\Illuminate\Support\Str::limit($article->description, 60)); ?>

                                    <?php else: ?>
                                        <?php echo e(\Illuminate\Support\Str::limit($article->description_ar, 60)); ?>

                                    <?php endif; ?>
                                </div>
                                <div class="date">
                                    <?php
                                        $date = Carbon\Carbon::parse($article->created_at)->format('l, F jS');
                                    ?>
                                    <?php if(Session::get('locale') == 'en'): ?>
                                        <?php echo e($date); ?>

                                        <?php else: ?>
                                        <?php echo e(\google_translate($date,'ar','en')); ?>

                                    <?php endif; ?>
                                </div>
                                <ul class="tags">
                                    <?php if(Session::get('locale') == 'en'): ?>
                                    <?php $__currentLoopData = array_slice(explode(',', $article->tags), 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <Link class="link outline-btn" href="/articles?tag=<?php echo e($tag); ?>"><?php echo e($tag); ?></Link>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php else: ?>
                                    <?php $__currentLoopData = array_slice(explode(',', $article->tags_ar), 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <Link class="link outline-btn" href="/articles?tag=<?php echo e($tag); ?>"><?php echo e($tag); ?></Link>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>
                                <Link href="/articles/<?php echo e($article->id); ?>" class="btn primary-btn">
                                    <?php echo app('translator')->get('buttons.read'); ?>
                                </Link>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                    <?php echo e($articles->links('vendor.pagination.bootstrap-5')); ?>

                    
                <?php else: ?>
                    <p class="note text-red-500" style="font-size: 30px;"><?php echo app('translator')->get('messages.noArticles'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH /home/ywyh/coding/github/perfecthealth/resources/views/frontend/articles/index.blade.php ENDPATH**/ ?>