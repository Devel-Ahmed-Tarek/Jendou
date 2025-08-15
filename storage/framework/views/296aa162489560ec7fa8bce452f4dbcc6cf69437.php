<?php
    $isactivateCarrier = isActivePluging('carrier');
?>
<?php if($isactivateCarrier): ?>
    <li class="<?php echo e(Request::routeIs(['plugin.carrier.list']) ? 'active ' : ''); ?>">
        <a href="<?php echo e(route('plugin.carrier.list')); ?>"><?php echo e(translate('Carriers')); ?></a>
    </li>
<?php endif; ?>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/carrier/views/includes/submenu/shipping.blade.php ENDPATH**/ ?>