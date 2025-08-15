<?php if(isActivePluging('pickuppoint')): ?>
    <li
        class="<?php echo e(Request::routeIs(['plugin.pickuppoint.edit.pickup.point', 'plugin.pickuppoint.pickup.points']) ? 'active ' : ''); ?>">
        <a href="<?php echo e(route('plugin.pickuppoint.pickup.points')); ?>"><?php echo e(translate('Pickup Points')); ?></a>
    </li>
<?php endif; ?>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/pickuppoint/views/includes/submenu/shipping.blade.php ENDPATH**/ ?>