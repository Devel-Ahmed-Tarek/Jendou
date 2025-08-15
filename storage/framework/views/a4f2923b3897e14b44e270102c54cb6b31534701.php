<!--Theme Options Modules-->
<?php if(auth()->user()->can('Manage Theme General settings') ||
        auth()->user()->can('Manage Home Page Builder') ||
        auth()->user()->can('Manage Slider Settings') ||
        auth()->user()->can('Manage Widget')): ?>
    <li
        class="<?php echo e(Request::routeIs(['theme.tlcommerce.home.page.sections.edit', 'theme.tlcommerce.home.page.sections.new', 'theme.tlcommerce.home.page.sections', 'theme.tlcommerce.sliders.edit', 'theme.tlcommerce.sliders.new', 'theme.tlcommerce.sliders', 'theme.tlcommerce.options']) ? 'active sub-menu-opened' : ''); ?>">
        <a href="#">
            <i class="icofont-ui-theme"></i>
            <span class="link-title"><?php echo e(translate('Theme Options')); ?></span>
        </a>
        <ul class="nav sub-menu">
            <?php if(auth()->user()->can('Manage Theme General settings')): ?>
                <li class="<?php echo e(Request::routeIs(['theme.tlcommerce.options']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('theme.tlcommerce.options')); ?>"><?php echo e(translate('General settings')); ?></a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->can('Manage Home Page Builder')): ?>
                <li
                    class="<?php echo e(Request::routeIs(['theme.tlcommerce.home.page.sections.edit', 'theme.tlcommerce.home.page.sections']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('theme.tlcommerce.home.page.sections')); ?>"><?php echo e(translate('Home Page Builder')); ?></a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->can('Manage Slider Settings')): ?>
                <li class="<?php echo e(Request::routeIs(['theme.tlcommerce.sliders']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('theme.tlcommerce.sliders')); ?>"><?php echo e(translate('Slider Settings')); ?></a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->can('Manage Widget')): ?>
                <!--Widget Module-->
                <li class="<?php echo e(Request::routeIs(['theme.tlcommerce.widgets']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('theme.tlcommerce.widgets')); ?>">
                        <span class="link-title"><?php echo e(translate('Widgets')); ?></span>
                    </a>
                </li>
                <!--End Widget Module-->
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<!--End Theme Options Modules-->
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/includes/themeOptions.blade.php ENDPATH**/ ?>