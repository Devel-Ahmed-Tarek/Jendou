<!--Refunds Module-->
<?php if(auth()->user()->can('Manage Refund Requests') || auth()->user()->can('Manage Refund reasons')): ?>
    <li
        class="<?php echo e(Request::routeIs(['plugin.refund.requests', 'plugin.refund.reason.edit', 'plugin.refund.reasons.list']) ? 'active sub-menu-opened' : ''); ?>">
        <a href="#">
            <i class="icofont-ui-previous"></i>
            <span class="link-title"><?php echo e(translate('Refunds')); ?></span>
        </a>
        <ul class="nav sub-menu">
            <?php if(auth()->user()->can('Manage Refund Requests')): ?>
                <li class="<?php echo e(Request::routeIs(['plugin.refund.requests']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('plugin.refund.requests')); ?>"><?php echo e(translate('Refund Requests')); ?></a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->can('Manage Refund reasons')): ?>
                <li
                    class="<?php echo e(Request::routeIs(['plugin.refund.reason.edit', 'plugin.refund.reasons.list']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('plugin.refund.reasons.list')); ?>"><?php echo e(translate('Refund Reasons')); ?></a>
                </li>
            <?php endif; ?>

        </ul>
    </li>
<?php endif; ?>
<!--End Refunds Module-->
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/refund/views/includes/navbar.blade.php ENDPATH**/ ?>