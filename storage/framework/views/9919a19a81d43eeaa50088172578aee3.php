<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="landing">
        <div class="wrapper">
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper"
                id="swiper_landing">
                <div class="parallax-bg" data-swiper-parallax="-23%"></div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="start">
                            <div class="texts">
                                <div class="title" data-swiper-parallax="-300"><?php echo app('translator')->get('frontpage.landingTitleOne'); ?></div>
                                <div class="text" data-swiper-parallax="-100">
                                    <p>
                                        <?php echo app('translator')->get('frontpage.landingDescriptionOne'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="buttons">
                                <button class="contact"><span><?php echo app('translator')->get('frontpage.landingBtnOne'); ?></span></button>
                                <button class="learn"><span><?php echo app('translator')->get('frontpage.landingBtnTwo'); ?></span></button>
                            </div>
                        </div>
                        <div class="end">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="start">
                            <div class="texts">
                                <div class="title" data-swiper-parallax="-300"><?php echo app('translator')->get('frontpage.landingTitleTwo'); ?></div>
                                <div class="text" data-swiper-parallax="-100">
                                    <p>
                                        <?php echo app('translator')->get('frontpage.landingDescriptionTwo'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="buttons">
                                <button class="contact"><span><?php echo app('translator')->get('frontpage.landingBtnOne'); ?></span></button>
                                <button class="learn"><span><?php echo app('translator')->get('frontpage.landingBtnTwo'); ?></span></button>
                            </div>
                        </div>
                        <div class="end">
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="stats">
                <div class="wrapper">
                    <div class="overlay"></div>
                    <div class="box">
                        <div class="icon">
                            <i class="fa-regular fa-calendar-check fa-2x"></i>
                        </div>
                        <div class="number">
                            <span class="number"><?php echo e(\Carbon\Carbon::now()->year - 1995); ?></span>
                        </div>
                        <div class="title">
                            <?php echo app('translator')->get('frontpage.statsTxtOne'); ?>
                        </div>
                    </div>
                    <div class="box">
                        <div class="icon">
                            <i class="fa-regular fa-heart fa-2x"></i>
                        </div>
                        <div class="number">
                            <span class="number">1000+</span>
                        </div>
                        <div class="title">
                            <?php echo app('translator')->get('frontpage.statsTxtTwo'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about">
        <div class="wrapper">
            <div class="start">
                <div class="img-box col">
                    <img src="<?php echo e(asset('images/waleed.png')); ?>" alt="">
                </div>
            </div>
            <div class="end">
                <div class="title">
                    <?php echo app('translator')->get('frontpage.aboutTitle'); ?>
                </div>
                <div class="description">
                    <?php echo app('translator')->get('frontpage.aboutDescription'); ?>
                </div>
                <ul class="checks">
                    <li>
                        <div class="icon">
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="96.000000pt"
                                height="96.000000pt" viewBox="0 0 96.000000 96.000000"
                                preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,96.000000) scale(0.100000,-0.100000)" fill="#000000"
                                    stroke="none">
                                    <path
                                        d="M347 840 c-26 -9 -53 -22 -59 -28 -7 -7 -18 -12 -24 -12 -16 0 -124 -108 -124 -124 0 -6 -5 -17 -11 -23 -23 -23 -48 -119 -48 -183 0 -64 25 -160 48 -183 6 -6 11 -17 11 -23 0 -16 108 -124 124 -124 6 0 17 -5 24 -12 20 -20 125 -48 182 -48 57 0 162 28 182 48 7 7 18 12 24 12 16 0 124 108 124 124 0 6 5 17 12 24 20 20 48 125 48 182 0 79 -8 102 -34 98 -19 -3 -22 -11 -27 -88 -13 -176 -78 -265 -237 -324 -130 -48 -307 22 -375 149 -34 62 -47 109 -47 165 0 107 69 231 155 278 130 71 246 68 364 -10 41 -27 44 -28 57 -11 21 28 17 36 -32 66 -113 68 -232 85 -337 47z" />
                                    <path
                                        d="M641 566 c-86 -86 -163 -156 -170 -156 -8 0 -38 23 -68 51 -54 51 -85 60 -91 26 -4 -21 133 -167 158 -167 25 0 373 355 368 376 -9 46 -40 25 -197 -130z" />
                                </g>
                            </svg>
                        </div>
                        <div class="txt">
                            <?php echo app('translator')->get('frontpage.aboutCheckOne'); ?>
                        </div>
                    </li>
                    <li>
                        <div class="icon">
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="96.000000pt"
                                height="96.000000pt" viewBox="0 0 96.000000 96.000000"
                                preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,96.000000) scale(0.100000,-0.100000)" fill="#000000"
                                    stroke="none">
                                    <path
                                        d="M347 840 c-26 -9 -53 -22 -59 -28 -7 -7 -18 -12 -24 -12 -16 0 -124 -108 -124 -124 0 -6 -5 -17 -11 -23 -23 -23 -48 -119 -48 -183 0 -64 25 -160 48 -183 6 -6 11 -17 11 -23 0 -16 108 -124 124 -124 6 0 17 -5 24 -12 20 -20 125 -48 182 -48 57 0 162 28 182 48 7 7 18 12 24 12 16 0 124 108 124 124 0 6 5 17 12 24 20 20 48 125 48 182 0 79 -8 102 -34 98 -19 -3 -22 -11 -27 -88 -13 -176 -78 -265 -237 -324 -130 -48 -307 22 -375 149 -34 62 -47 109 -47 165 0 107 69 231 155 278 130 71 246 68 364 -10 41 -27 44 -28 57 -11 21 28 17 36 -32 66 -113 68 -232 85 -337 47z" />
                                    <path
                                        d="M641 566 c-86 -86 -163 -156 -170 -156 -8 0 -38 23 -68 51 -54 51 -85 60 -91 26 -4 -21 133 -167 158 -167 25 0 373 355 368 376 -9 46 -40 25 -197 -130z" />
                                </g>
                            </svg>
                        </div>
                        <div class="txt">
                            <?php echo app('translator')->get('frontpage.aboutCheckTwo'); ?>
                        </div>
                    </li>
                    <li>
                        <div class="icon">
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="96.000000pt"
                                height="96.000000pt" viewBox="0 0 96.000000 96.000000"
                                preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,96.000000) scale(0.100000,-0.100000)" fill="#000000"
                                    stroke="none">
                                    <path
                                        d="M347 840 c-26 -9 -53 -22 -59 -28 -7 -7 -18 -12 -24 -12 -16 0 -124 -108 -124 -124 0 -6 -5 -17 -11 -23 -23 -23 -48 -119 -48 -183 0 -64 25 -160 48 -183 6 -6 11 -17 11 -23 0 -16 108 -124 124 -124 6 0 17 -5 24 -12 20 -20 125 -48 182 -48 57 0 162 28 182 48 7 7 18 12 24 12 16 0 124 108 124 124 0 6 5 17 12 24 20 20 48 125 48 182 0 79 -8 102 -34 98 -19 -3 -22 -11 -27 -88 -13 -176 -78 -265 -237 -324 -130 -48 -307 22 -375 149 -34 62 -47 109 -47 165 0 107 69 231 155 278 130 71 246 68 364 -10 41 -27 44 -28 57 -11 21 28 17 36 -32 66 -113 68 -232 85 -337 47z" />
                                    <path
                                        d="M641 566 c-86 -86 -163 -156 -170 -156 -8 0 -38 23 -68 51 -54 51 -85 60 -91 26 -4 -21 133 -167 158 -167 25 0 373 355 368 376 -9 46 -40 25 -197 -130z" />
                                </g>
                            </svg>
                        </div>
                        <div class="txt">
                            <?php echo app('translator')->get('frontpage.aboutCheckThree'); ?>
                        </div>
                    </li>
                </ul>
                <div class="more">
                    <Link class="btn" href="<?php echo e(Route('info.index')); ?>">
                    <?php echo app('translator')->get('frontpage.aboutBtn'); ?>
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <?php if(count($services) > 0): ?>
        <div class="services">
            <div class="main-title">
                <div class="txt"><?php echo app('translator')->get('frontpage.servicesTitle'); ?></div>
                <div class="icons">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                        viewBox="0 0 50 50">
                        <path
                            d="M 32.21875 2.0625 L 31.4375 2.375 L 28.625 3.46875 L 27.84375 3.78125 L 28.03125 4.59375 L 28.625 7.59375 C 28.332031 7.886719 28.019531 8.230469 27.6875 8.59375 L 24.71875 7.9375 L 23.90625 7.75 L 23.59375 8.5 L 22.375 11.3125 L 22.0625 12.0625 L 22.75 12.53125 L 25.3125 14.25 C 25.28125 14.738281 25.285156 15.230469 25.3125 15.71875 L 22.6875 17.34375 L 21.96875 17.78125 L 22.28125 18.5625 L 23.375 21.375 L 23.6875 22.15625 L 24.5 21.96875 L 27.5 21.375 C 27.804688 21.738281 28.140625 22.066406 28.5 22.375 L 27.8125 25.375 L 27.625 26.1875 L 28.40625 26.53125 L 31.21875 27.71875 L 31.96875 28.03125 L 32.4375 27.34375 L 34.15625 24.78125 C 34.644531 24.8125 35.136719 24.808594 35.625 24.78125 L 37.25 27.4375 L 37.6875 28.125 L 38.46875 27.84375 L 42.0625 26.40625 L 41.875 25.59375 L 41.1875 22.3125 C 41.5625 21.996094 41.902344 21.65625 42.21875 21.28125 L 45.25 22.0625 L 46.09375 22.28125 L 46.40625 21.5 L 47.625 18.6875 L 47.96875 17.90625 L 47.21875 17.4375 L 44.59375 15.84375 C 44.625 15.355469 44.621094 14.863281 44.59375 14.375 L 47.21875 12.75 L 47.9375 12.3125 L 47.625 11.53125 L 46.53125 8.71875 L 46.21875 7.9375 L 45.375 8.125 L 42.3125 8.8125 C 42.007813 8.449219 41.671875 8.121094 41.3125 7.8125 L 41.96875 4.8125 L 42.15625 4 L 41.40625 3.6875 L 38.59375 2.46875 L 37.8125 2.15625 L 37.34375 2.875 L 35.75 5.40625 C 35.289063 5.359375 34.789063 5.402344 34.28125 5.4375 L 32.65625 2.78125 Z M 31.375 4.53125 L 32.84375 6.9375 L 33.21875 7.53125 L 33.90625 7.375 C 34.613281 7.21875 35.28125 7.304688 36.1875 7.40625 L 36.8125 7.46875 L 37.15625 6.9375 L 38.59375 4.65625 L 39.84375 5.1875 L 39.21875 7.875 L 39.0625 8.53125 L 39.625 8.90625 C 40.238281 9.34375 40.75 9.855469 41.1875 10.46875 L 41.5625 11.03125 L 42.21875 10.875 L 44.96875 10.25 L 45.46875 11.5 L 43.0625 12.9375 L 42.53125 13.28125 L 42.59375 13.90625 C 42.6875 14.742188 42.6875 15.445313 42.59375 16.28125 L 42.53125 16.90625 L 43.0625 17.25 L 45.4375 18.71875 L 44.9375 19.90625 L 42.15625 19.21875 L 41.46875 19.0625 L 41.09375 19.625 C 40.65625 20.238281 40.144531 20.75 39.53125 21.1875 L 39 21.5625 L 39.125 22.21875 L 39.75 25.1875 L 38.5 25.65625 L 37.0625 23.28125 L 36.71875 22.75 L 36.09375 22.8125 C 35.257813 22.90625 34.554688 22.90625 33.71875 22.8125 L 33.09375 22.75 L 32.78125 23.25 L 31.25 25.5625 L 29.96875 25 L 30.5625 22.3125 L 30.71875 21.6875 L 30.1875 21.28125 C 29.574219 20.84375 29.0625 20.332031 28.625 19.71875 L 28.25 19.1875 L 27.59375 19.3125 L 24.90625 19.875 L 24.4375 18.625 L 26.8125 17.15625 L 27.375 16.8125 L 27.28125 16.1875 C 27.1875 15.351563 27.1875 14.648438 27.28125 13.8125 L 27.375 13.21875 L 26.84375 12.875 L 24.53125 11.34375 L 25.0625 10.0625 L 27.78125 10.6875 L 28.375 10.8125 L 28.75 10.34375 C 29.320313 9.679688 29.90625 9.09375 30.40625 8.59375 L 30.78125 8.21875 L 30.6875 7.71875 L 30.125 5.03125 Z M 35 10 C 32.25 10 30 12.25 30 15 C 30 17.75 32.25 20 35 20 C 37.75 20 40 17.75 40 15 C 40 12.25 37.75 10 35 10 Z M 35 12 C 36.667969 12 38 13.332031 38 15 C 38 16.667969 36.667969 18 35 18 C 33.332031 18 32 16.667969 32 15 C 32 13.332031 33.332031 12 35 12 Z M 13.53125 20 L 13.40625 20.84375 L 12.90625 24.09375 C 12.363281 24.265625 11.839844 24.515625 11.34375 24.78125 L 7.90625 22.28125 L 4.40625 25.78125 L 4.875 26.46875 L 6.78125 29.21875 C 6.511719 29.753906 6.273438 30.289063 6.09375 30.8125 L 2.8125 31.40625 L 2 31.5625 L 2 36.4375 L 2.8125 36.59375 L 6.09375 37.1875 C 6.269531 37.734375 6.511719 38.246094 6.78125 38.75 L 4.8125 41.40625 L 4.28125 42.09375 L 7.78125 45.59375 L 8.46875 45.125 L 11.21875 43.21875 C 11.753906 43.488281 12.289063 43.726563 12.8125 43.90625 L 13.3125 47.15625 L 13.4375 48 L 18.34375 48 L 18.46875 47.1875 L 19.09375 43.90625 C 19.636719 43.734375 20.160156 43.484375 20.65625 43.21875 L 24.09375 45.71875 L 27.59375 42.21875 L 27.125 41.53125 L 25.125 38.75 C 25.386719 38.222656 25.636719 37.703125 25.8125 37.1875 L 29.1875 36.59375 L 30 36.4375 L 30 31.53125 L 25.78125 30.90625 C 25.609375 30.367188 25.390625 29.839844 25.125 29.34375 L 27.125 26.59375 L 27.59375 25.90625 L 27.03125 25.3125 L 24.71875 22.90625 L 24.125 22.28125 L 23.40625 22.78125 L 20.65625 24.78125 C 20.128906 24.519531 19.609375 24.269531 19.09375 24.09375 L 18.59375 20.84375 L 18.46875 20 Z M 15.25 22 L 16.75 22 L 17.3125 25.5625 L 17.875 25.75 C 18.773438 26.050781 19.613281 26.332031 20.28125 26.75 L 20.84375 27.09375 L 21.375 26.71875 L 23.875 24.90625 L 25 26.09375 L 23.1875 28.625 L 22.78125 29.15625 L 23.15625 29.71875 C 23.605469 30.4375 23.957031 31.269531 24.125 32.03125 L 24.28125 32.6875 L 24.9375 32.78125 L 28 33.25 L 28 34.78125 L 24.9375 35.3125 L 24.34375 35.40625 L 24.15625 35.96875 C 23.855469 36.867188 23.574219 37.707031 23.15625 38.375 L 22.78125 38.9375 L 23.1875 39.46875 L 25 42 L 23.875 43.09375 L 21.375 41.28125 L 20.84375 40.90625 L 20.28125 41.25 C 19.5625 41.699219 18.730469 42.050781 17.96875 42.21875 L 17.34375 42.375 L 17.21875 43.03125 L 16.6875 46 L 15.15625 46 L 14.59375 42.4375 L 14.03125 42.25 C 13.132813 41.949219 12.292969 41.667969 11.625 41.25 L 11.0625 40.90625 L 10.53125 41.28125 L 8 43 L 6.90625 41.90625 L 8.6875 39.5 L 9.125 38.9375 L 8.75 38.375 C 8.300781 37.65625 7.949219 36.855469 7.78125 36.09375 L 7.625 35.4375 L 6.96875 35.3125 L 4 34.78125 L 4 33.21875 L 6.96875 32.6875 L 7.5625 32.5625 L 7.75 32.03125 C 8.050781 31.132813 8.332031 30.292969 8.75 29.625 L 9.09375 29.0625 L 8.71875 28.53125 L 7 26 L 8.125 24.90625 L 10.625 26.71875 L 11.15625 27.09375 L 11.71875 26.75 C 12.4375 26.300781 13.269531 25.949219 14.03125 25.78125 L 14.6875 25.625 L 14.78125 24.96875 Z M 16 29 C 13.253906 29 11 31.253906 11 34 C 11 36.746094 13.253906 39 16 39 C 18.746094 39 21 36.746094 21 34 C 21 31.253906 18.746094 29 16 29 Z M 16 31 C 17.65625 31 19 32.34375 19 34 C 19 35.65625 17.65625 37 16 37 C 14.34375 37 13 35.65625 13 34 C 13 32.34375 14.34375 31 16 31 Z">
                        </path>
                    </svg>
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="50.000000pt" height="50.000000pt"
                        viewBox="0 0 50.000000 50.000000" preserveAspectRatio="xMidYMid meet">
                        <g transform="translate(0.000000,50.000000) scale(0.100000,-0.100000)" fill="#000000"
                            stroke="none">
                            <path
                                d="M265 472 c-55 -22 -75 -36 -97 -67 -33 -48 -34 -66 -8 -122 10 -24 15 -43 10 -43 -6 0 -10 -22 -10 -50 l0 -50 85 0 85 0 0 55 c0 30 4 55 10 55 15 0 80 61 80 74 0 7 11 35 25 62 29 56 27 67 -12 88 -54 28 -94 27 -168 -2z m135 -8 c22 -9 40 -19 40 -23 0 -23 -53 -129 -72 -144 -60 -47 -131 -88 -144 -83 -26 10 -15 46 20 67 19 11 46 35 60 53 l25 34 -42 4 c-34 4 -47 0 -65 -18 -16 -16 -22 -29 -17 -43 6 -21 -8 -60 -17 -45 -3 5 -11 26 -17 46 -11 33 -10 41 12 74 18 29 39 44 88 65 78 33 79 33 129 13z m-135 -141 c-19 -17 -31 -21 -38 -14 -15 15 23 49 47 43 18 -5 17 -7 -9 -29z m-34 -133 c9 0 24 7 35 15 30 23 44 18 44 -15 l0 -30 -65 0 -65 0 0 32 c0 29 1 30 18 15 10 -10 25 -17 33 -17z" />
                            <path
                                d="M63 124 c-18 -8 -33 -19 -33 -24 0 -14 16 -12 51 6 28 14 35 14 95 -6 35 -12 64 -26 64 -31 0 -12 0 -12 -48 5 -25 9 -44 11 -47 5 -4 -5 0 -11 7 -13 7 -2 29 -9 48 -16 30 -9 37 -8 50 8 8 10 29 23 45 29 17 6 38 14 48 18 10 4 17 3 17 -4 0 -6 -32 -27 -72 -47 l-72 -36 -62 22 c-61 21 -64 21 -93 4 -17 -10 -31 -22 -31 -26 0 -12 23 -9 43 6 15 11 27 11 82 -6 l64 -20 78 40 c56 28 79 46 81 61 5 31 -18 35 -74 13 l-49 -20 -64 24 c-72 27 -83 28 -128 8z" />
                        </g>
                    </svg>
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="50.000000pt" height="50.000000pt"
                        viewBox="0 0 50.000000 50.000000" preserveAspectRatio="xMidYMid meet">
                        <g transform="translate(0.000000,50.000000) scale(0.100000,-0.100000)" fill="#000000"
                            stroke="none">
                            <path
                                d="M17 482 c-16 -18 -16 -21 5 -60 14 -25 30 -42 41 -42 9 0 45 -27 80 -61 45 -44 62 -68 62 -87 0 -18 8 -30 24 -38 13 -7 30 -25 36 -41 18 -43 141 -153 170 -153 32 0 65 33 65 65 0 29 -110 152 -153 170 -16 6 -34 23 -41 36 -8 16 -20 24 -38 24 -20 0 -43 17 -87 64 -34 34 -61 71 -61 80 0 10 -16 26 -37 36 -21 11 -41 21 -44 22 -3 2 -13 -5 -22 -15z m74 -48 c0 -5 33 -43 75 -85 41 -41 71 -78 67 -82 -4 -4 -41 26 -82 67 -42 42 -80 75 -85 75 -12 -1 -46 53 -40 63 7 10 66 -25 65 -38z m201 -176 c2 -14 16 -29 36 -38 36 -17 152 -141 152 -162 0 -19 -20 -38 -39 -38 -24 1 -142 113 -160 152 -10 20 -25 34 -39 36 -28 4 -28 19 0 49 27 29 46 29 50 1z" />
                            <path
                                d="M307 193 c-3 -5 22 -38 57 -72 35 -35 66 -59 69 -54 3 5 -22 38 -57 72 -35 35 -66 59 -69 54z" />
                            <path
                                d="M334 489 c-16 -5 -41 -20 -53 -33 -20 -21 -23 -33 -18 -66 3 -22 1 -43 -4 -46 -5 -3 -9 -12 -9 -21 0 -13 5 -12 25 7 18 17 22 27 14 36 -20 24 -6 67 30 91 46 31 72 31 43 0 -30 -32 -28 -48 11 -85 39 -38 53 -39 85 -9 l24 22 -7 -25 c-20 -64 -62 -93 -105 -70 -16 9 -25 9 -36 -1 -20 -17 -12 -21 46 -26 43 -3 53 0 74 20 28 28 52 97 42 123 -6 15 -11 13 -41 -16 l-35 -34 -32 32 -32 32 32 33 c44 45 24 59 -54 36z" />
                            <path
                                d="M150 225 c-15 -15 -34 -25 -52 -25 -86 0 -127 -103 -66 -167 60 -64 167 -22 172 66 1 16 10 39 20 50 15 17 16 21 4 21 -25 0 -48 -35 -48 -73 0 -38 -35 -77 -71 -77 -48 0 -89 41 -89 91 0 32 44 69 83 69 23 0 41 8 60 28 15 15 27 31 27 35 0 14 -17 6 -40 -18z" />
                            <path
                                d="M78 153 c-22 -5 -35 -50 -21 -71 28 -46 87 -40 98 9 11 50 -22 77 -77 62z m50 -26 c6 -7 9 -23 5 -36 -4 -17 -12 -21 -32 -19 -32 4 -41 36 -15 55 22 16 29 16 42 0z" />
                        </g>
                    </svg>
                </div>
            </div>
            <div class="wrapper">
                <?php if(Session::get('locale') == 'en'): ?>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box">
                            <div class="inner">
                                <div class="front">
                                    <div class="logo">
                                        <?php if(Storage::exists('public/' . $service->image)): ?>
                                            <img src="<?php echo e('storage/' . $service->image); ?>" alt="">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/' . 'images/services/logo/default.png')); ?>"
                                                alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="title"><?php echo e($service->title); ?></div>
                                </div>
                                <div class="back">
                                    <div class="description"><?php echo e($service->description); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box">
                            <div class="inner">
                                <div class="front">
                                    <div class="logo">
                                        <?php if(Storage::exists('public/' . $service->image_ar)): ?>
                                            <img src="<?php echo e('storage/' . $service->image_ar); ?>" alt="">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/' . 'images/services/logo/default.png')); ?>"
                                                alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="title"><?php echo e($service->title_ar); ?></div>
                                </div>
                                <div class="back">
                                    <div class="description"><?php echo e($service->description_ar); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php if(count($insurances) > 0): ?>
        <?php endif; ?>
        <div class="incurances">
            <div class="main-title">
                <div class="txt"><?php echo app('translator')->get('frontpage.insurancesTitle'); ?></div>
                <div class="icons">
                    <i class="fa-regular fa-handshake"></i>
                    <i class="fa-regular fa-face-smile"></i>
                    <i class="fa-regular fa-hand"></i>
                </div>
            </div>
            <div class="wrapper">
                <div class="container swiper">
                    <div class="content" id="swiper_incurance">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $insurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="box swiper-slide">
                                    <?php if(Storage::exists('public/' . $insurance->image)): ?>
                                        <img src="<?php echo e(asset('storage/' . $insurance->image)); ?>" alt="">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('storage/' . 'images/insurances/logos/default.png')); ?>"
                                            alt="">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(count($articles) > 0): ?>
        <div class="articles main">
            <div class="overlay"></div>
            <div class="main-title">
                <div class="txt"><?php echo app('translator')->get('frontpage.articlesTitle'); ?></div>
                <div class="icons">
                    <i class="fa-regular fa-newspaper"></i>
                    <i class="fa-regular fa-comment"></i>
                    <i class="fa-regular fa-comments"></i>
                </div>
            </div>
            <div class="wrapper">
                <div class="container swiper">
                    <div class="content" id="swiper_article">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="box swiper-slide">
                                    <?php if(Session::get('locale') == 'en'): ?>
                                        <?php if(Storage::exists('public/' . $article->image)): ?>
                                            <img src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="image"
                                                class="img">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/' . 'images/articles/thumbnails/default.png')); ?>"
                                                alt="">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(Storage::exists('public/' . $article->image_ar)): ?>
                                            <img src="<?php echo e(asset('storage/' . $article->image_ar)); ?>" alt="image"
                                                class="img">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/' . 'images/articles/thumbnails/default.png')); ?>"
                                                alt="">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="data">
                                        <div class="pad-box">
                                            <div class="text">
                                                <div class="title">
                                                    <?php if(Session::get('locale') == 'en'): ?>
                                                        <?php echo e($article->title); ?>

                                                    <?php else: ?>
                                                        <?php echo e($article->title_ar); ?>

                                                    <?php endif; ?>
                                                </div>
                                                <div class="description">
                                                    <?php if(Session::get('locale') == 'en'): ?>
                                                        <?php echo e(\Illuminate\Support\Str::limit($article->description, 100)); ?>

                                                    <?php else: ?>
                                                        <?php echo e(\Illuminate\Support\Str::limit($article->description_ar, 100)); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <p class="time">
                                                <div class="date">
                                                    <?php
                                                        $carbon = Carbon\Carbon::parse($article->created_at)->format(
                                                            'l, F jS',
                                                        );
                                                    ?>
                                                    <?php if(Session::get('locale') == 'en'): ?>
                                                        <?php echo e($carbon); ?>

                                                    <?php else: ?>
                                                        <?php echo e(\google_translate($carbon, 'ar', 'en')); ?>

                                                    <?php endif; ?>
                                                </div>
                                                </p>
                                                <Link href="/articles/<?php echo e($article->id); ?>" class="read">
                                                <?php echo app('translator')->get('buttons.read'); ?>
                                                <i class="fa-solid fa-arrow-right"></i>
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <!-- Navigation buttons -->
                    <!-- Pagination -->
                    <div class="swiper-pagination" id="swiper-pagination-article"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="social overlay">
        <div class="main-title">
            <div class="txt"><?php echo app('translator')->get('frontpage.contactTitle'); ?></div>
            <div class="icons">
                <i class="fa-regular fa-share-from-square"></i>
                <i class="fa-regular fa-thumbs-up"></i>
                <i class="fa-solid fa-share-nodes"></i>
            </div>
        </div>
        <div class="wrapper">
            <div class="row">
                <div class="social-bar">
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=100083383471982" target="_blank"
                            class="icon link facebook">
                            <div class="tooltip">
                                <?php echo app('translator')->get('frontpage.facebook'); ?>
                            </div>
                            <span><i class="fab fa-facebook-f"></i></span>
                        </a>
                        <a class="icon link messanger" href="https://m.me/waleed.haikal.3" target="_blank">
                            <div class="tooltip">
                                <?php echo app('translator')->get('frontpage.messenger'); ?>
                            </div>
                            <span><i class="fab fa-facebook-messenger"></i></span>
                        </a>
                        <a class="icon link whatsapp" href="https://wa.me/201024824716" target="_blank">
                            <div class="tooltip">
                                <?php echo app('translator')->get('frontpage.whatsapp'); ?>
                            </div>
                            <span><i class="fab fa-whatsapp"></i></span>
                        </a>
                        <a href="mailto:support@waleedhaikal.com" class="icon link mail">
                            <div class="tooltip">
                                <?php echo app('translator')->get('frontpage.mail'); ?>
                            </div>
                            <span><i class="fa-regular fa-envelope"></i></span>
                        </a>
                        <a class="icon link phone" href="tel:201024824716">
                            <div class="tooltip">
                                <?php echo app('translator')->get('frontpage.phone'); ?>
                            </div>
                            <span><i class="fa-solid fa-phone"></i></span>
                        </a>
                        <a class="icon link globe" href="https://waleedhaikal.com">
                            <div class="tooltip">
                                <?php echo app('translator')->get('frontpage.website'); ?>
                            </div>
                            <span><i class="fa-solid fa-globe"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="location">
        <div class="overlay"></div>
        <div class="main-title">
            <div class="txt"><?php echo app('translator')->get('frontpage.locationTitle'); ?></div>
            <div class="icons">
                <i class="fa-solid fa-earth-americas"></i>
                <i class="fa-solid fa-map-location-dot"></i>
                <i class="fa-solid fa-location-crosshairs"></i>
            </div>
        </div>
        <div class="wrapper">
            <div class="box">
                <div class="column">
                    <div class="title"><?php echo app('translator')->get('frontpage.locationBoxOneTitle'); ?></div>
                    <div class="description"><?php echo app('translator')->get('frontpage.locationBoxOneDescription'); ?></div>
                    <div class="days"><?php echo app('translator')->get('frontpage.locationBoxOneDays'); ?></div>
                    <div class="hours"><?php echo app('translator')->get('frontpage.locationBoxOneHours'); ?></div>
                </div>
                <div class="gps">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.38880130795!2d30.939041000000003!3d29.968254400000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14585792ece9fd53%3A0x6564db9fc992e56d!2z2LnZitin2K_YqSDYry4vINmI2YTZitivINmK2KfYs9mK2YYg2YfZitmD2YQ!5e0!3m2!1sen!2sus!4v1697218525100!5m2!1sen!2sus"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="divider"></div>
            <div class="box">
                <div class="column">
                    <div class="title"><?php echo app('translator')->get('frontpage.locationBoxTwoTitle'); ?></div>
                    <div class="description"><?php echo app('translator')->get('frontpage.locationBoxTwoDescription'); ?></div>
                    <div class="days"><?php echo app('translator')->get('frontpage.locationBoxTwoDays'); ?></div>
                    <div class="hours"><?php echo app('translator')->get('frontpage.locationBoxTwoHours'); ?></div>
                </div>
                <div class="gps">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.235845021833!2d31.000935000000002!3d30.03009099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14585a17a37e3a29%3A0x41d07da521e06b17!2sDown%20Town!5e0!3m2!1sen!2sus!4v1697218545996!5m2!1sen!2sus"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
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
<?php if (isset($component)) { $__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b = $component; } ?>
<?php $component = ProtoneMedia\Splade\Components\Script::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('splade-script'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\Splade\Components\Script::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    
    let swiperLanding = new Swiper("#swiper_landing", {
    loop: true,
    spaceBetween: 10,
    grabCursor: true,
    freeMode: true,
    autoplay: {
    delay: 5000,
    disableOnInteraction: false
    },
    speed: 3000,
    parallax: true,
    pagination: {
    el: ".swiper-pagination",
    clickable: true,
    },
    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
    },
    });
    let swiperArticle = new Swiper("#swiper_article", {
    loop: true,
    spaceBetween: 10,
    grabCursor: true,
    freeMode: true,
    autoplay: {
    delay: 1,
    disableOnInteraction: false
    },
    speed: 3000,
    pagination: {
    el: "#swiper-pagination-article",
    clickable: true,
    dynamicBullets: true,
    },

    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
    },

    breakpoints:{
    767: {
    slidesPerView: 2,
    },
    991: {
    slidesPerView: 3,
    },
    },
    });
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b)): ?>
<?php $component = $__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b; ?>
<?php unset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b); ?>
<?php endif; ?>
<?php /**PATH /home/ywyh/coding/github/perfecthealth/resources/views/frontend/home.blade.php ENDPATH**/ ?>