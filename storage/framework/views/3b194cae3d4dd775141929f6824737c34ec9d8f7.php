<div class="card">
    <div class="card-body">
        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black "><?php echo e(translate('Enable Tax')); ?>

                </label>
            </div>
            <div class="col-sm-1">
                <label class="switch glow primary medium">
                    <input type="checkbox" name="enable_tax_in_checkout" <?php if(getEcommerceSetting('enable_tax_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                    <span class="control"></span>
                </label>
            </div>
            <div class="col-sm-7">
                <p class="mt-0 font-13">
                    <?php echo e(translate('You can manage tax profile from')); ?>

                    <a href="<?php echo e(route('plugin.tlcommercecore.ecommerce.settings.taxes.list')); ?>"
                        class="btn-link"><?php echo e(translate('Tax')); ?>

                    </a>
                </p>
            </div>
        </div>

    </div>
</div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/ecommerce-settings/tax.blade.php ENDPATH**/ ?>