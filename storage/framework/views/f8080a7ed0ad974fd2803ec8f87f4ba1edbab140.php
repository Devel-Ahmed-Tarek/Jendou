<?php
    $isactivateFlashdeal = isActivePluging('flashdeal');
?>
<?php if($isactivateFlashdeal): ?>
    <?php if(auth()->user()->can('Manage Flash Deals')): ?>
        <li class="<?php echo e(Request::routeIs(['plugin.flashdeal.list']) ? 'active ' : ''); ?>">
            <a href="<?php echo e(route('plugin.flashdeal.list')); ?>"><?php echo e(translate('Flash Deals')); ?></a>
        </li>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/flashdeal/views/includes/submenu/marketing.blade.php ENDPATH**/ ?>