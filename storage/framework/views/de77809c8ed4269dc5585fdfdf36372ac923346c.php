<header class="header white-bg fixed-top d-flex align-content-center flex-wrap">
    <?php echo $__env->make('core::base.layouts.headerLogo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main Header -->
    <div class="main-header">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-3 col-lg-1 col-xl-4">
                    <!-- Header Left -->
                    <div class="main-header-left h-100 d-flex align-items-center">
                        <!-- Main Header User -->
                        <?php if(auth()->guard()->check()): ?>
                            <div class="main-header-user">
                                <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                    <div class="menu-icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="user-profile d-lg-flex align-items-center d-none">
                                        <!-- User Avatar -->
                                        <div class="user-avatar">
                                            <?php if(auth()->user()->image != null): ?>
                                                <img src="<?php echo e(asset(getFilePath(auth()->user()->image))); ?>"
                                                    alt="<?php echo e(auth()->user()->name); ?>">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('/public/backend/assets/img/avatar/user.png')); ?>"
                                                    alt="<?php echo e(auth()->user()->name); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <!-- End User Avatar -->

                                        <!-- User Info -->
                                        <div class="user-info">
                                            <h4 class="user-name"><?php echo e(auth()->user()->name); ?></h4>
                                            <p class="user-email"><?php echo e(auth()->user()->email); ?></p>
                                        </div>
                                        <!-- End User Info -->
                                    </div>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="<?php echo e(route('core.profile')); ?>"><?php echo e(translate('My Profile')); ?></a>
                                    <a href="<?php echo e(route('core.logout')); ?>"><?php echo e(translate('Log Out')); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- End Main Header User -->
                        <!-- Main Header Menu -->
                        <div class="main-header-menu d-block d-lg-none">
                            <div class="header-toogle-menu">
                                <img src="<?php echo e(asset('/public/backend/assets/img/menu.png')); ?>" alt="">
                            </div>
                        </div>
                        <!-- End Main Header Menu -->
                    </div>
                    <!-- End Header Left -->
                </div>
                <div class="col-9 col-lg-11 col-xl-8">
                    <!-- Header Right -->
                    <div class="main-header-right d-flex justify-content-end">
                        <ul class="nav">
                            <li class="d-none d-lg-flex">
                                <!-- Main Header Time -->
                                <div class="main-header-date-time text-right"
                                    data-timezone="<?php echo e(getGeneralSetting('default_timezone')); ?>" id="dateTime">
                                    <h3 class="time">
                                        <span id="hours">21</span>
                                        <span id="point">:</span>
                                        <span id="min">06</span>
                                    </h3>
                                    <span class="date"><span id="date">Tue, 12 October
                                            2019</span></span>
                                </div>
                                <!-- End Main Header Time -->
                            </li>
                            <li class="d-none d-lg-flex">
                                <!-- Main Header Button -->
                                <div class="main-header-btn ml-md-1">
                                    <a href="<?php echo e(route('core.admin.clear.system.cache')); ?>"
                                        class="btn"><?php echo e(translate('Clear Cache')); ?></a>
                                </div>
                                <!-- End Main Header Button -->
                            </li>
                            <li class="ml-3">
                                <!-- Visit website -->
                                <div class="main-header-notification">
                                    <a href="/" target="_blank" title="Visit website"
                                        class="header-icon notification-icon">
                                        <img src="<?php echo e(asset('/public/backend/assets/img/svg/globe-icon.svg')); ?>"
                                            alt="bell" class="svg">
                                    </a>
                                </div>
                                <!-- End Visit website -->
                            </li>
                            <li class="ml-3">
                                <!-- Main Header Language -->
                                <div class="main-header-notification">
                                    <a href="#" class="header-icon notification-icon" data-toggle="dropdown"
                                        title="Language Options">
                                        <?php if(isset($active_lang->code)): ?>
                                            <img src="<?php echo e(asset('/public/flags/') . '/' . $active_lang->code . '.png'); ?>"
                                                class="w-20" alt="<?php echo e($active_lang->code); ?>">
                                        <?php endif; ?>
                                    </a>
                                    <div id="lang-change" class="dropdown-menu style--three">
                                        <?php $__currentLoopData = $active_langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="#" class="dropdown-item" data-lan="<?php echo e($lang->code); ?>">
                                                <img src="<?php echo e(asset('/public/flags/') . '/' . $lang->code . '.png'); ?>"
                                                    class="mr-2 w-20" alt="<?php echo e($lang->code); ?>">
                                                <?php echo e($lang->native_name); ?>

                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <!-- End Main Header Language -->
                            </li>
                            <li>
                                <!-- Main Header Notification -->
                                <div class="main-header-notification">
                                    <a href="#" class="header-icon notification-icon" data-toggle="dropdown"
                                        title="Notification">
                                        <span class="count notification-counter"
                                            data-bg-img="<?php echo e(asset('/public/backend/assets/img/count-bg.png')); ?>">0</span>
                                        <img src="<?php echo e(asset('/public/backend/assets/img/svg/notification-icon.svg')); ?>"
                                            alt="bell" class="svg">
                                    </a>
                                    <div class="dropdown-menu style--two dropdown-menu-right py-0">
                                        <div
                                            class="dropdown-header bg-primary-light d-flex align-items-center justify-content-between">
                                            <h4 class="py-2 font-weight-normal"><?php echo e(translate('Notifications')); ?></h4>
                                            <a href="#"
                                                class="text-mute mark-as-all-read d-none"><?php echo e(translate('Clear all')); ?></a>
                                        </div>
                                        <div class="dropdown-body notification-list-items">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Main Header Notification -->
                            </li>
                        </ul>
                    </div>
                    <!-- End Header Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Header -->
</header>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/Core/Views/base/layouts/header.blade.php ENDPATH**/ ?>