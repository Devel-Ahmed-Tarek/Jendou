<?php
    $isactivatePickupPoint = isActivePluging('pickuppoint');
?>
<?php if($isactivatePickupPoint): ?>
    <?php if(auth()->user()->can('Manage Pickup Point Order')): ?>
        <li class="<?php echo e(Request::routeIs(['plugin.pickuppoint.orders']) ? 'active ' : ''); ?>">
            <a href="<?php echo e(route('plugin.pickuppoint.orders')); ?>"><?php echo e(translate('Pickup Point Order')); ?></a>
        </li>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/pickuppoint/views/includes/submenu/order.blade.php ENDPATH**/ ?>