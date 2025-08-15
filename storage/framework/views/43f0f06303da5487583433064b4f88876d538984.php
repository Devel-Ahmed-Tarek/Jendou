<div class="card">
    <div class="card-body">
        <div class="form-row mb-20">
            <div class="col-sm-6">
                <label class="font-14 bold black"><?php echo e(translate('Customer auto approval')); ?>

                </label>
            </div>
            <div class="col-sm-6">
                <label class="switch glow primary medium">
                    <input type="checkbox" name="customer_auto_approved" <?php if(getEcommerceSetting('customer_auto_approved') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                    <span class="control"></span>
                </label>
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-6">
                <label class="font-14 bold black"><?php echo e(translate('Customer email verification')); ?>

                </label>
            </div>
            <div class="col-sm-1">
                <label class="switch glow primary medium">
                    <input type="checkbox" name="customer_email_varification" <?php if(getEcommerceSetting('customer_email_varification') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                    <span class="control"></span>
                </label>
            </div>
            <div class="col-sm-5">
                <p class="mt-0 font-13">
                    <?php echo e(translate('Enable customer email verification you need to complete email configuration and Cron Job setup')); ?>

                    <br>
                    <a href="<?php echo e(route('core.email.smtp.configuration')); ?>"
                        class="btn-link"><?php echo e(translate('Configure Email')); ?>

                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/ecommerce-settings/customer.blade.php ENDPATH**/ ?>