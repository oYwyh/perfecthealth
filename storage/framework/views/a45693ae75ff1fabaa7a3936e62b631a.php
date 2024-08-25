<div class="header" href="<?php echo e(route('home')); ?>">
    <Link class="logo" href="<?php echo e(route('home')); ?>">
        
        <img src="<?php echo e(asset('images/logo/perfect.png')); ?>" alt="">
        
    </Link>
    <div class="toggle">
        <div class="icon" id="toggle">

            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="40px" viewBox="0 0 300.000000 300.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M105 2321 c-48 -22 -69 -44 -90 -94 -13 -31 -15 -128 -15 -729 0 -651 2 -695 19 -733 22 -48 44 -69 94 -90 32 -13 194 -15 1387 -15 1193 0 1355 2 1387 15 50 21 72 42 94 90 17 38 19 82 19 735 0 653 -2 697 -19 735 -22 48 -44 69 -94 90 -32 13 -194 15 -1389 15 -1291 0 -1355 -1 -1393 -19z m2755 -121 c20 -20 20 -33 20 -700 0 -667 0 -680 -20 -700 -20 -20 -33 -20 -670 -20 -637 0 -650 0 -670 20 -20 20 -20 33 -20 700 0 667 0 680 20 700 20 20 33 20 670 20 637 0 650 0 670 -20z"/> </g> </svg>
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
    const toggle = document.getElementById('toggle');
    const iconPath = document.querySelector('#toggle svg path');
    const toggleOff = 'M105 2321 c-48 -22 -69 -44 -90 -94 -13 -31 -15 -128 -15 -729 0 -651 2 -695 19 -733 22 -48 44 -69 94 -90 32 -13 194 -15 1387 -15 1193 0 1355 2 1387 15 50 21 72 42 94 90 17 38 19 82 19 735 0 653 -2 697 -19 735 -22 48 -44 69 -94 90 -32 13 -194 15 -1389 15 -1291 0 -1355 -1 -1393 -19z m1375 -121 c20 -20 20 -33 20 -700 0 -667 0 -680 -20 -700 -20 -20 -33 -20 -670 -20 -637 0 -650 0 -670 20 -20 20 -20 33 -20 700 0 667 0 680 20 700 20 20 33 20 670 20 637 0 650 0 670 -20z m1380 0 c20 -20 20 -33 20 -700 0 -667 0 -680 -20 -700 -20 -20 -33 -20 -633 -20 l-612 0 0 720 0 720 613 0 c599 0 612 0 632 -20z'
    const toggleOn = 'M105 2321 c-48 -22 -69 -44 -90 -94 -13 -31 -15 -128 -15 -729 0 -651 2 -695 19 -733 22 -48 44 -69 94 -90 32 -13 194 -15 1387 -15 1193 0 1355 2 1387 15 50 21 72 42 94 90 17 38 19 82 19 735 0 653 -2 697 -19 735 -22 48 -44 69 -94 90 -32 13 -194 15 -1389 15 -1291 0 -1355 -1 -1393 -19z m2755 -121 c20 -20 20 -33 20 -700 0 -667 0 -680 -20 -700 -20 -20 -33 -20 -670 -20 -637 0 -650 0 -670 20 -20 20 -20 33 -20 700 0 667 0 680 20 700 20 20 33 20 670 20 637 0 650 0 670 -20z'

    const sidebar = document.getElementById('sidebar');


    if(window.matchMedia("(max-width: 991px)").matches) {
        localStorage.setItem('sidebarState', 'small'); // Save the state to localStorage
    }

    // Load the sidebar state from localStorage
    const sidebarState = localStorage.getItem('sidebarState');
    if (sidebarState === 'small') {
        sidebar.classList.add('small');
        iconPath.setAttribute('d', toggleOff);
    }

    toggle.addEventListener('click',() => {
        sidebar.classList.toggle('small')
        if(iconPath.getAttribute('d') == toggleOn) {
            iconPath.setAttribute('d',toggleOff)
            localStorage.setItem('sidebarState', 'small'); // Save the state to localStorage
        }else {
            iconPath.setAttribute('d',toggleOn)
            if(window.matchMedia("(max-width: 991px)").matches) {
                localStorage.setItem('sidebarState', 'small'); // Save the state to localStorage
            }else {
                localStorage.setItem('sidebarState', 'big'); // Save the state to localStorage
            }
        }
    })
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b)): ?>
<?php $component = $__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b; ?>
<?php unset($__componentOriginal85e14d8f2eb9be41c54f3ef4caf4b63b); ?>
<?php endif; ?>
<?php /**PATH /home/ywyh/coding/github/perfecthealth/resources/views/components/partials/sidebar-header.blade.php ENDPATH**/ ?>