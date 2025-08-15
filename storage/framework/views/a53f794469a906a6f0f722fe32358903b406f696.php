<!-- Logo -->
<?php if($mood == 'dark'): ?>
    <div class="logo pl-20 bg-transparent align-items-center d-flex">
        <?php if(sizeof($logo_details) > 0 && isset($logo_details['admin_dark_logo'])): ?>
            <a href="/" class="default-logo"><img
                    src="<?php echo e(project_asset($logo_details['admin_dark_logo'])); ?>"></a>
        <?php else: ?>
            <h3 class="default-logo"><?php echo e($logo_details['system_name']); ?></h3>
        <?php endif; ?>

        <?php if(sizeof($logo_details) > 0 && isset($logo_details['admin_dark_mobile_logo'])): ?>
            <a href="/" class="mobile-logo"><img
                    src="<?php echo e(project_asset($logo_details['admin_dark_mobile_logo'])); ?>"></a>
        <?php else: ?>
            <h3 class="mobile-logo"><?php echo e($logo_details['system_name']); ?></h3>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="logo pl-20 bg-white align-items-center d-flex">
        <?php if(sizeof($logo_details) > 0 && isset($logo_details['admin_logo'])): ?>
            <a href="/" class="default-logo"><img
                    src="<?php echo e(project_asset($logo_details['admin_logo'])); ?>"></a>
        <?php else: ?>
            <h3 class="default-logo"><?php echo e($logo_details['system_name']); ?></h3>
        <?php endif; ?>

        <?php if(sizeof($logo_details) > 0 && isset($logo_details['admin_mobile_logo'])): ?>
            <a href="/" class="mobile-logo"><img
                    src="<?php echo e(project_asset($logo_details['admin_mobile_logo'])); ?>"></a>
        <?php else: ?>
            <h3 class="mobile-logo"><?php echo e($logo_details['system_name']); ?></h3>
        <?php endif; ?>
    </div>
<?php endif; ?>
<!-- End Logo -->
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/Core/Views/base/layouts/headerLogo.blade.php ENDPATH**/ ?>