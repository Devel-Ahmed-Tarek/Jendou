<?php
    $isactivateCoupon = isActivePluging('coupon');
?>
<?php if($isactivateCoupon): ?>
    <?php if(auth()->user()->can('Manage Coupons')): ?>
        <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.marketing.coupon.list']) ? 'active ' : ''); ?>">
            <a href="<?php echo e(route('plugin.tlcommercecore.marketing.coupon.list')); ?>"><?php echo e(translate('Coupons')); ?></a>
        </li>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/coupon/views/includes/submenu/marketing.blade.php ENDPATH**/ ?>